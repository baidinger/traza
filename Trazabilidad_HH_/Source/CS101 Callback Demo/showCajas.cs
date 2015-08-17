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
    public partial class showCajas : Form
    {
        public int Socio, id_Envio, id_Orden, id_Carro, datosTabla = 0, rowIndex = -10;
        public String Palet = "", Caja="";
        public DataTable dt;

        public showCajas(int socio, int id_envio, int id_orden, int id_carro, String palet)
        {
            InitializeComponent();

            this.Socio = socio;
            this.id_Envio = id_envio;
            this.id_Orden = id_orden;
            this.id_Carro = id_carro;
            this.Palet = palet;

            this.palet_lbl.Text = Palet;
            this.envio_lbl.Text = id_Envio + "";
            this.orden_lbl.Text = id_Orden + "";
            this.carro_lbl.Text = id_Carro + "";

            switch (socio)
            {
                case 1:
                    break;
                case 2:
                    break;
                case 3:
                    break;
                case 4:
                    this.palet_lbl.Visible = false;
                    this.label1.Visible = false;
                    break;
            }

            dt = new DataTable();
            DataColumn col;

            col = dt.Columns.Add();
            col.ColumnName = "#";
            col.DataType = typeof(int);

            col = dt.Columns.Add();
            col.ColumnName = "EPC de la caja";
            col.DataType = typeof(string);

            col = dt.Columns.Add();
            col.ColumnName = "Enviado";
            col.DataType = typeof(string);

            col = dt.Columns.Add();
            col.ColumnName = "Recibido";
            col.DataType = typeof(string);

            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                /*LLENAR LA TABLA CON LOS ENVIOS PENDIENTES*/
                refreshCajas();
            }
        }

        public void refreshCajas(){
            dt.Rows.Clear();
            String r = "";
            DataRow row;
            r = webServiceDataGrid();

            String[] res = r.Split('*');

            if (res[0].CompareTo("Error") == 0)
            {
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
                    for (int i = 0, j = 0; i < tamanio / 3; i++)
                    {

                        row = dt.NewRow();
                        row[0] = i+1;
                        row[1] = datosEnvios[j];
                        row[2] = datosEnvios[j + 1];
                        row[3] = datosEnvios[j + 2];
                        dt.Rows.Add(row);
                        j += 3;

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
                if (y == 1)
                    tbcName.Width = 180;
                else
                    if(y==0)
                        tbcName.Width = 30;
                    else
                        tbcName.Width = 55;
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
            string uriEnvios = Program.uri + "cuentaCajas.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=" + Socio + "," + id_Envio + "," + Palet);
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
                    Caja = dt.Rows[dataGrid1.CurrentRowIndex][1].ToString();
                    traza_btn.Enabled = true;
                }
                rowIndex = dataGrid1.CurrentRowIndex;
            }
        }

        private void traza_btn_Click(object sender, EventArgs e)
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
               // MessageBox.Show(res[1]);
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

                postBytes = Encoding.UTF8.GetBytes("datos=" + Caja);
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
    }
}