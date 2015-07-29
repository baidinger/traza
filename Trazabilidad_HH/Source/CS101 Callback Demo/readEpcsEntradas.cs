#define NONBLOCKING
using System;
using System.Collections;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using System.Threading;
using System.IO;
using System.Diagnostics;

namespace CS101_CALLBACK_API_DEMO
{
    using CSLibrary;
    using CSLibrary.Constants;
    using CSLibrary.Structures;
    using CSLibrary.Device;
    using CSLibrary.Text;

    using CSLibrary.HotKeys;
    using System.Net;


    public partial class readEpcsEntradas : Form
    {
        #region Private Member

        private int m_totaltag = 0;

        private bool m_stop = false;

        private bool m_selected = false;

        private TagDataModel m_tagTable = new TagDataModel(SlowFlags.INDEX | SlowFlags.EPC);

        private DateTime timeStarted = DateTime.MinValue;

        public int socio, id_socio, id_orden, id_carro, cajaCont = 0, tarimaCont = 0, id_usuario;
        public String nombreSocio;
        enum ButtonState : int
        {
            Start = 0,
            Stop,
            Select,
            Unknow
        }

        #endregion

        #region Form
        public readEpcsEntradas(int socio, int id_socio, int id_orden, int id_carro, string nombreSocio, string sender, int id_usuario)
        {
            InitializeComponent();

            this.id_usuario = id_usuario;
            this.socio = socio;
            this.id_socio = id_socio;
            this.id_orden = id_orden;
            this.id_carro = id_carro;
            this.nombreSocio = nombreSocio;

            /*if (socio == 2)
                socio_lbl.Text = "Empaque";
            if(socio == 3)
                socio_lbl.Text = "Distribuidor";*/

            socio_lbl.Text = sender+"";
            id_orden_lbl.Text = id_orden+"";
            id_carro_lbl.Text = id_carro+"";
            dest_lbl.Text = nombreSocio;
        }

        protected override void OnPaint(PaintEventArgs e)
        {
            // For an image added as a project resource in Visual Studio, 
            // get the resource by name. 
            Bitmap backgroundImage = Properties.Resources.Iniciosesion;
            // Otherwise, get the image compiled as an embedded resource.
            // Assembly asm = Assembly.GetExecutingAssembly();
            // Bitmap backgroundImage = new Bitmap(asm.GetManifestResourceStream("mypicture.jpg"));

            e.Graphics.DrawImage(backgroundImage, this.ClientRectangle,
                new Rectangle(0, 0, backgroundImage.Width, backgroundImage.Height),
                GraphicsUnit.Pixel);
        }

        public readEpcsEntradas(bool selectable)
        {
            InitializeComponent();

            m_selected = selectable;
        }

        private void SearchForm_Load(object sender, EventArgs e)
        {
            //Third Step (Attach to Form)
            AttachCallback(true);
            nTable.BindModel(m_tagTable);
            nTable.SetColumnWidth(0, 80);

            nTable.AutoMoveRow = false;
          
            startMenu1.ShowSortFlag = SlowFlags.EPC | SlowFlags.INDEX;
        }

        private void SearchForm_Closing(object sender, CancelEventArgs e)
        {
            //Fourth Step (Dettach from Form and Stop)
            if (Program.ReaderCE.State != RFState.IDLE)
            {
                m_stop = e.Cancel = true;
                Program.ReaderCE.StopOperation(true);
            }
            else
            {
                AttachCallback(false);
            }
        }
        #endregion

        #region Event Callback
        private void AttachCallback(bool en)
        {
            if (en)
            {
                HotKeys.OnKeyEvent += new HotKeys.HotKeyEventArgs(HotKeys_OnKeyEvent);

                Program.ReaderCE.OnStateChanged +=new EventHandler<CSLibrary.Events.OnStateChangedEventArgs>(ReaderCE_StateChangedEvent);
                Program.ReaderCE.OnAsyncCallback += new EventHandler<CSLibrary.Events.OnAsyncCallbackEventArgs>(ReaderCE_TagInventoryEvent);
            }
            else
            {
                HotKeys.OnKeyEvent -= new HotKeys.HotKeyEventArgs(HotKeys_OnKeyEvent);

                Program.ReaderCE.OnAsyncCallback -= new EventHandler<CSLibrary.Events.OnAsyncCallbackEventArgs>(ReaderCE_TagInventoryEvent);
                Program.ReaderCE.OnStateChanged -= new EventHandler<CSLibrary.Events.OnStateChangedEventArgs>(ReaderCE_StateChangedEvent);
            }
        }

        void HotKeys_OnKeyEvent(Key KeyCode, bool KeyDown)
        {
            if (KeyDown)
            {
                switch (KeyCode)
                {
                    case Key.F2:
                        Program.Profile.ProfileUp();
                        break;
                    case Key.F3:
                        Program.Profile.ProfileDown();
                        break;
                    case Key.F4:
                        //PowerUp
                        Program.Power.PowerUp();
                        break;
                    case Key.F5:
                        //PowerDown
                        Program.Power.PowerDown();
                        break;
                    case Key.F11:
                        Start();
                        break;
                }
            }
            else
            {
                if (KeyCode == Key.F11)
                {
                    Stop();
                }
            }
        }

        void ReaderCE_TagInventoryEvent(object sender, CSLibrary.Events.OnAsyncCallbackEventArgs e)
        {
            Invoke((System.Threading.ThreadStart)delegate()
            {
                //Using asyn delegate to update UI
                if (e.type == CallbackType.TAG_INVENTORY)
                {
                    m_totaltag++;

                    UpdateRecords(e.info);

                    if (Program.appSetting.Cfg_blocking_mode)
                    {
                        Application.DoEvents();
                    }

                    //btn_start.BackColor = Color.FromArgb(0, 192, 0);
                    //btn_start.Text = "Start";
                    //bToggleStartButton = false;
                    //btn_clear.Enabled = btn_exit.Enabled = btn_save.Enabled = cb_sorting.Enabled = true;
                    //startMenu1_OnButtonClick(ButtonClickType.Stop);
                    //Stop();
                }
            });
        }

        void ReaderCE_StateChangedEvent(object sender, CSLibrary.Events.OnStateChangedEventArgs e)
        {
            Invoke((System.Threading.ThreadStart)delegate()
            {
                switch (e.state)
                {
                    case RFState.IDLE:
                        EnableUpdate(false);
                        if (!m_stop)
                        {
                            m_totaltag = 0;
                            Device.MelodyPlay(RingTone.T1, BuzzerVolume.HIGH);
                            startMenu1.ToggleStartButton();
                            EnableForm(true);
                            RefreshListView();
                        }
                        else
                        {
                            CloseForm();
                        }
                        break;
                    case RFState.BUSY:
                        EnableUpdate(true);
                        Device.MelodyPlay(RingTone.T2, BuzzerVolume.HIGH);
                        startMenu1.ToggleStartButton();
                        timeStarted = CSLibrary.Tools.DateTimeEx.Now;
                        break;
                    case RFState.ABORT:
                        EnableForm(false);
                        break;
                    case RFState.RESET:
                        EnableUpdate(false);
                        Program.ReaderCE.Reconnect(10);
                        Program.ReaderCE.StartOperation(Operation.TAG_INVENTORY, Program.appSetting.Cfg_blocking_mode);
                        EnableUpdate(true);
                        break;
                }
            });
        }

        #endregion

        #region UI Update
        private void UpdateRecords(object data)
        {
            TagCallbackInfo record = (TagCallbackInfo)data;
            if (record != null)
            {
                m_tagTable.AddItem(record);
               
            }
        }
        private void EnableUpdate(bool en)
        {
            tmr_readrate.Enabled = en;
        }
        private void CloseForm()
        {
            this.Close();
        }
        private void EnableForm(bool en)
        {
            this.Enabled = en;
        }
        private void RefreshListView()
        {
            m_tagTable.Redraw();
        }

        /*METODO PARA SABER CUANDO SE SELECCIONA UN EPC EN LA TABLA*/

        private void nTable_RowChanged(int rowIndex)
        {
            if (m_selected)
            {
                startMenu1.UpdateStartBtn(true);
            }
          //  String epc = m_tagTable.Items[rowIndex].epc + "";
          //  startMenu1.UpdateTimeElapsed(epc);
        }


        private void tmr_readrate_Tick(object sender, EventArgs e)
        {
            RefreshListView();
            startMenu1.UpdateTagCount(m_totaltag);
            startMenu1.UpdateTimeElapsed(((TimeSpan)CSLibrary.Tools.DateTimeEx.Now.Subtract(timeStarted)).TotalSeconds);
            Device.BuzzerOn(3000, 40, BuzzerVolume.HIGH);
        }
        #endregion

        #region Button Handle

        public void Start()
        {
            if (Program.ReaderCE.State == RFState.IDLE)
            {
                m_tagTable.Clear();
                Program.ReaderCE.SetOperationMode(Program.appSetting.Cfg_continuous_mode ? RadioOperationMode.CONTINUOUS : RadioOperationMode.NONCONTINUOUS);
                Program.ReaderCE.SetTagGroup(Program.appSetting.tagGroup);
                Program.ReaderCE.SetSingulationAlgorithmParms(Program.appSetting.Singulation, Program.appSetting.SingulationAlg);
                Program.ReaderCE.Options.TagInventory.flags = SelectFlags.ZERO;

                Program.ReaderCE.Options.TagInventory.multibanks = 0;
                Program.ReaderCE.Options.TagInventory.bank1 = MemoryBank.TID;
                Program.ReaderCE.Options.TagInventory.offset1 = 2;
                Program.ReaderCE.Options.TagInventory.count1 = 2;

                Program.ReaderCE.StartOperation(Operation.TAG_INVENTORY, Program.appSetting.Cfg_blocking_mode);
            }
        }

        private void Stop()
        {
            cajaCont = 0;
            tarimaCont = 0;
         
            if (Program.ReaderCE.State == RFState.BUSY)
            {
                Program.ReaderCE.StopOperation(true);
                //MessageBox.Show("termino leer");

                if (m_tagTable.Items.Count > 0)
                {
                    String epcs = "";
                    DateTime date = DateTime.Now;
                    foreach (TagCallbackInfo data in m_tagTable.Items)
                    {
                        string tipo = data.epc.ToString().Substring(0, 2);
                        if (tipo.CompareTo("00") == 0)
                            cajaCont++;

                        if (tipo.CompareTo("01") == 0)
                            tarimaCont++;
                    }

                    cajas_lbl.Text = cajaCont + "";
                    tarima_lbl.Text = tarimaCont + "";
                    startMenu1.UpdateTagCount(cajaCont + tarimaCont);
                }
            }
        }

        /******GUARDO LAS CAJAS Y TARIMAS******/
        private void Save()
        {
            if (tarimaCont == 1)
            {
                if (m_tagTable.Items.Count > 0)
                {
                    String epcs = "";
                    DateTime date = DateTime.Now;
                    string tipo;
                    String tarima = "", cajas = "", respuesta = "";
                    using (cargando c = new cargando())
                    {
                        c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                        c.Show();
                        c.Update();
                        foreach (TagCallbackInfo data in m_tagTable.Items)
                        {
                            epcs += data.epc.ToString() + ",";
                            tipo = data.epc.ToString().Substring(0, 2);
                            if (tipo.CompareTo("01") == 0)
                            {
                                tarima = data.epc.ToString();
                            }
                            else
                            {
                                if (cajas.CompareTo("") == 0)
                                    cajas += data.epc.ToString();
                                else
                                    cajas += "*" + data.epc.ToString();
                            }

                        }

                        respuesta = compararCajasTarimasService(cajas, tarima);
                    }
                    String[] resp = respuesta.Split('*');

                    if (resp[0].CompareTo("Error") == 0)
                        MessageBox.Show(resp[1], "Error");
                    else
                        if (res[0].CompareTo("Error1") == 0)
                        {
                            MessageBox.Show(res[1] + "\n - Intente de nuevo.", "Error de conexión");
                        }
                        else
                        {
                            m_tagTable.Clear();
                            startMenu1.UpdateTimeElapsed(000);
                            startMenu1.UpdateTagCount(000);
                            cajas_lbl.Text = "000";
                            tarima_lbl.Text = "000";
                            MessageBox.Show(resp[1], "Comparación exitosa");
                        }

                }
                else
                    MessageBox.Show("No hay epcs");
            }
            else
            {
                MessageBox.Show("Error al guardar.  \n - Solo se puede guardar un solo Pallet por lectura de cajas.","Error");
            }
        }


        public String compararCajasTarimasService(String cajas, String tarima)
        {
            string uriEnvios = Program.uri + "comparaCajasTarimas.php";
            HttpWebRequest request;
            byte[] postBytes;
            Stream requestStream;
            HttpWebResponse response;
            Stream responseStream;

            try
            {
                /*PETICIÓN AL WEBSERVER*/
                request = (HttpWebRequest)WebRequest.Create(uriEnvios);
                request.Method = "POST";
                request.KeepAlive = false;
                request.ProtocolVersion = HttpVersion.Version10;

                postBytes = Encoding.UTF8.GetBytes("datos=" + socio + "," + id_carro + "," + id_orden + "," + cajas + "," + tarima);
                request.ContentType = "application/x-www-form-urlencoded";
                request.AllowWriteStreamBuffering = false;
                request.ContentLength = postBytes.Length;
                request.AllowAutoRedirect = false;

                requestStream = request.GetRequestStream();
                requestStream.Write(postBytes, 0, postBytes.Length);
                requestStream.Close();

                /*RESPUESTA DEL WEBSERVER*/
                response = (HttpWebResponse)request.GetResponse();
                responseStream = response.GetResponseStream();

                string jsonString = null;
                using (StreamReader reader2 = new StreamReader(responseStream))
                {
                    jsonString = reader2.ReadToEnd();
                    reader2.Close();
                }
                responseStream.Close();
                response.Close();

                return jsonString;

            }
            catch (Exception e2)
            {
                // return "Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
                return "Error1*Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }
        }

        public String finalizarPreEnvio()
        {
            string regEnvios = Program.uri + "finalizarPreEnvios.php";
            HttpWebRequest request;
            byte[] postBytes;
            Stream requestStream;
            HttpWebResponse response;
            Stream responseStream;
            string jsonString = "";

            try
            {
                /*PETICIÓN AL WEBSERVER*/
                request = (HttpWebRequest)WebRequest.Create(regEnvios);
                request.Method = "POST";
                request.KeepAlive = false;
                request.ProtocolVersion = HttpVersion.Version10;

                postBytes = Encoding.UTF8.GetBytes("datos=" + socio + "," + id_carro + "," + id_orden);
                request.ContentType = "application/x-www-form-urlencoded";
                request.AllowWriteStreamBuffering = false;
                request.ContentLength = postBytes.Length;
                request.AllowAutoRedirect = false;

                requestStream = request.GetRequestStream();
                requestStream.Write(postBytes, 0, postBytes.Length);
                requestStream.Close();

                /*RESPUESTA DEL WEBSERVER*/
                response = (HttpWebResponse)request.GetResponse();
                responseStream = response.GetResponseStream();


                using (StreamReader reader2 = new StreamReader(responseStream))
                {
                    jsonString = reader2.ReadToEnd();
                    reader2.Close();
                }
                responseStream.Close();
                response.Close();

                // MessageBox.Show(jsonString);
                return jsonString;
            }
            catch (Exception e2)
            {
                return "Error*Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }

        }

        void startMenu1_OnButtonClick(ButtonClickType type)
        {
            switch (type)
            {
                case ButtonClickType.Finalizar:
                   // MessageBox.Show("Finalizar");
                    String result;
                    using (cargando c = new cargando())
                    {
                        c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                        c.Show();
                        c.Update();
                        result = finalizarPreEnvio();
                    }
                    String[] r = result.Split('*');

                    if (r[0].CompareTo("Error") == 0)
                    {
                        MessageBox.Show(r[1], "Error al enviar");
                    }
                    else
                    {
                        MessageBox.Show(r[1], "Operación exitosa");
                        this.Close();
                        using (enviosWorking env = new enviosWorking(socio, id_socio, id_usuario))
                        {
                            env.ShowDialog();
                        }
                    }
                    
                    
                    break;
                case ButtonClickType.Clear:
                    m_tagTable.Clear();
                    startMenu1.UpdateTimeElapsed(000);
                    startMenu1.UpdateTagCount(000);
                    cajas_lbl.Text = "000";
                    tarima_lbl.Text = "000";
                    break;
                case ButtonClickType.Exit:
                    this.Close();
                    using (entradasWorgking en = new entradasWorgking(socio, id_socio, id_usuario, nombreSocio))
                    {
                        en.ShowDialog();
                    }
                    break;
                case ButtonClickType.Hide:
                case ButtonClickType.Unhide:
                    //Resize list
                    nTable.Height = 270 - startMenu1.Height;
                    break;
                case ButtonClickType.Save:
                    Save();
                    break;
                case ButtonClickType.Start:
                    Start();
                    break;
                case ButtonClickType.Stop:
                    Stop();
                    break;
                case ButtonClickType.Sorting:
                    switch (startMenu1.SortingMethod)
                    {
                        case Sorting.EPC_Ascending:
                            m_tagTable.SortMethod = SortIndex.EPC;
                            m_tagTable.Ascending = true;
                            break;
                        case Sorting.EPC_Decending:
                            m_tagTable.SortMethod = SortIndex.EPC;
                            m_tagTable.Ascending = false;
                            break;
                        /*case Sorting.PC_Ascending:
                            m_tagTable.SortMethod = SortIndex.PC;
                            m_tagTable.Ascending = true;
                            break;
                        case Sorting.PC_Decending:
                            m_tagTable.SortMethod = SortIndex.PC;
                            m_tagTable.Ascending = false;
                            break;*/
                        case Sorting.INDEX_Ascending:
                            m_tagTable.SortMethod = SortIndex.INDEX;
                            m_tagTable.Ascending = true;
                            break;
                        case Sorting.INDEX_Decending:
                            m_tagTable.SortMethod = SortIndex.INDEX;
                            m_tagTable.Ascending = false;
                            break;
                    }
                    m_tagTable.Sort();
                    m_tagTable.Redraw();
                    break;
            }
        }

        #endregion

        private void startMenu1_Click(object sender, EventArgs e)
        {

        }

        private void nTable_Click(object sender, EventArgs e)
        {

        }

    }
}
