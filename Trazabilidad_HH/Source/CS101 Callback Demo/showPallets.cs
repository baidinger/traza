using System;
using System.Linq;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using System.Net;
using System.IO;

namespace CS101_CALLBACK_API_DEMO
{
    public partial class showPallets : Form
    {
        public DataTable dt;
        public int id_envio, socio, datosTabla = 0, rowIndex = -10;
        public String pallet="";

        public showPallets(int socio, int id_envio)
        {
            InitializeComponent();

            verCajasbtn.Enabled = false;

            this.socio = socio;
            this.id_envio = id_envio;
            this.envioNumber.Text = id_envio+"";

            dt = new DataTable();
            DataColumn col;

            col = dt.Columns.Add();
            col.ColumnName = "EPC del Pallet";
            col.DataType = typeof(string);

            col = dt.Columns.Add();
            col.ColumnName = "N° de cajas total";
            col.DataType = typeof(string);

            col = dt.Columns.Add();
            col.ColumnName = "N° Cajas enviadas";
            col.DataType = typeof(string);

            col = dt.Columns.Add();
            col.ColumnName = "N° Cajas recibidas";
            col.DataType = typeof(string);

            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                /*LLENAR LA TABLA CON LOS ENVIOS PENDIENTES*/
                refreshPallets();
            }
        }

        public void refreshPallets()
        {
            dt.Rows.Clear();
            String r = "";
            DataRow row;
            r = webServiceDataGrid();

            MessageBox.Show(r);

            String[] res = r.Split('*');

            if (res[0].CompareTo("Error") == 0)
            {
                // envios[] e = new envios[1];
                //  e[0] = new envios("---", "---", "---");
                // arrList.Add(e[0]);
                datosTabla = 0;

                row = dt.NewRow();
                row[0] = "---";
                row[1] = "---";
                row[2] = "---";
                row[3] = "---";
                dt.Rows.Add(row);
            }
            else
                if (res[0].CompareTo("Error1") == 0)
                {
                    MessageBox.Show(res[1], "Error de conexión");
                    this.Close();
                }
                else
                {
                    datosTabla = 1;
                    String[] datosEnvios = res[1].Split(',');
                    int tamanio = datosEnvios.Length - 1;
                    for (int i = 0, j=0; i < tamanio/4; i++)
                    {

                        row = dt.NewRow();
                        row[0] = datosEnvios[j];
                        row[1] = datosEnvios[j+1];
                        row[2] = datosEnvios[j + 2];
                        row[3] = datosEnvios[j + 3];
                        dt.Rows.Add(row);
                        j += 4;

                    }
                }
            dataGrid1.DataSource = dt;

            dataGrid1.TableStyles.Clear();
            DataGridTableStyle tableStyle = new DataGridTableStyle();
            tableStyle.MappingName = dt.TableName;
            int y = 0;
            foreach (DataColumn item in dt.Columns)
            {
                DataGridTextBoxColumn tbcName = new DataGridTextBoxColumn();
                if(y == 0)
                    tbcName.Width = 180;
                else
                    tbcName.Width = 130;
                tbcName.MappingName = item.ColumnName;
                tbcName.HeaderText = item.ColumnName;
                tableStyle.GridColumnStyles.Add(tbcName);
                y++;
            }
            y = 0;
            dataGrid1.TableStyles.Add(tableStyle);

            dataGrid1.Refresh();
        }

        public String webServiceDataGrid()
        {
            string uriEnvios = Program.uri + "cuentaPallets.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=2," + socio + "," +id_envio);
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
                return "Error1*Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void dataGrid1_CurrentCellChanged(object sender, EventArgs e)
        {
            dataGrid1.Select(dataGrid1.CurrentRowIndex);

            if (dataGrid1.CurrentRowIndex != rowIndex)
            {
                if (datosTabla == 1)
                {
                    pallet = dt.Rows[dataGrid1.CurrentRowIndex][0].ToString();
                    verCajasbtn.Enabled = true;
                    /*
                    String r = "";
                    using (cargando c = new cargando())
                    {
                        c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                        c.Show();
                        c.Update();
                        r = cuentaCajas();
                    }
                    String[] res = r.Split('*');

                    if (res[0].CompareTo("Error") == 0)
                    {
                        MessageBox.Show(res[1], "Error");
                    }
                    else
                        if (res[0].CompareTo("Error1") == 0)
                        {
                            MessageBox.Show(res[1] + "\n - Intente de nuevo.", "Error de conexión");
                        }
                        else
                        {
                            cajasNum.Text = res[1];
                        }
                    */
                }
                rowIndex = dataGrid1.CurrentRowIndex;
            }


        }

        public String cuentaCajas()
        {
            string uriEnvios = Program.uri + "cuentaPallets.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=3," + socio + "," + id_envio+ "," + pallet);
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
                return "Error1*Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }
        }

        private void verCajasbtn_Click(object sender, EventArgs e)
        {

        }
    }
}