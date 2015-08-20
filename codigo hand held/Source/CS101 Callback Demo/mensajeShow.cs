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
    public partial class mensajeShow : Form
    {
        public int id_envio, socio, id_carro, id_socio, id_usuario;
        public enviosWorking eW;
        public mensajeShow(String text, String title, int idEnvio, int socio, int id_carro, enviosWorking enviosW, int id_socio, int id_usuario)
        {
            InitializeComponent();

            this.id_envio = idEnvio;
            this.socio = socio;
            this.eW = enviosW;
            this.id_carro = id_carro;
            this.id_socio = id_socio;
            this.id_usuario = id_usuario;

            
            this.lbl_text.Text = text;
            this.Text = title;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                String result = eliminarEnvio();
                String[] r = result.Split('*');

                if (r[0].CompareTo("Error") == 0)
                {
                    MessageBox.Show(r[1], "Error al eliminar");
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
            }

        }

        public String eliminarEnvio()
        {
            string regEnvios = Program.uri + "eliminarEnvios.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=" + socio + "," + id_envio+","+id_carro);
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

        private void button2_Click(object sender, EventArgs e)
        {
            this.Close();
            using (enviosWorking env = new enviosWorking(socio, id_socio, id_usuario))
            {
                env.ShowDialog();
            }
        }
    }
}