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


    public partial class readEpcsTrazabilidad : Form
    {
        #region Private Member

        private int m_totaltag = 0;

        private bool m_stop = false;

        private bool m_selected = false;

        private TagDataModel m_tagTable = new TagDataModel(SlowFlags.INDEX | SlowFlags.EPC);

        private DateTime timeStarted = DateTime.MinValue;

        enum ButtonState : int
        {
            Start = 0,
            Stop,
            Select,
            Unknow
        }

        #endregion

        #region Form
        public readEpcsTrazabilidad()
        {
            InitializeComponent();

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

        public readEpcsTrazabilidad(bool selectable)
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

            }
            epc_lbl.Text = m_tagTable.Items[rowIndex].epc + "";
          //  String epc = m_tagTable.Items[rowIndex].epc + "";
          //  startMenu1.UpdateTimeElapsed(epc);
        }


        private void tmr_readrate_Tick(object sender, EventArgs e)
        {
            RefreshListView();
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
         
            if (Program.ReaderCE.State == RFState.BUSY)
            {
                Program.ReaderCE.StopOperation(true);
                //MessageBox.Show("termino leer");

            }
        }

        /******GUARDO LAS CAJAS Y TARIMAS******/
        private void Save()
        {
 
        }


     

        #endregion

        private void startMenu1_Click(object sender, EventArgs e)
        {

        }

        private void nTable_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {

            String r = "";
            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                r = Traz();
                //MessageBox.Show(r);
            }
            String[] res = r.Split('{');

            if (res[0].CompareTo("Error") == 0)
            {
                MessageBox.Show(res[1], "Error");
            }
            else
            {
                //MessageBox.Show(res[1]);
                using (Trazabilidad t = new Trazabilidad(res[1]))
                {
                    t.ShowDialog();
                }
            }
        }


        public String Traz()
        {
            string uriEnvios = Program.uri + "trazabilidad.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=" + epc_lbl.Text);
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
                return "Error{Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }

        }

        private void button2_Click(object sender, EventArgs e)
        {
            this.Close();
        }

    }
}
