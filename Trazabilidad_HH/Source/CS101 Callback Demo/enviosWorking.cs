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
using System.Collections;

namespace CS101_CALLBACK_API_DEMO
{

    public partial class enviosWorking : Form
    {
        public int socio, id_socio, id_usuario, datosTabla=0;
        public ArrayList arrList = new ArrayList();
        public envios[] e;
        public int preIdEnvio, preIdOrden, preIdCarro;

        public enviosWorking(int socio, int id_socio, int id_usuario)
        {
            InitializeComponent();

            String result = "";
            this.socio = socio;
            this.id_socio = id_socio;
            this.id_usuario = id_usuario;
            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                /*LLENAR LA TABLA CON LOS ENVIOS PENDIENTES*/
                refreshEnviosPendientes();

                /*CONEXIÓN AL WEBSERVER PARA LAS ORDENES*/
                result = webServiceConeccion(socio, id_socio, 1);
                String[] id_orden = result.Split(',');
                orden_cb.DataSource = id_orden;


                /*CONEXIÓN AL WEBSERVER PARA LOS CARROS*/
                result = webServiceConeccion(socio, id_socio, 2);
                String[] id_carro = result.Split(',');
                carro_cb.DataSource = id_carro;
                //MessageBox.Show(result+" \n "+result2);
            }
          
        }

        public void refreshEnviosPendientes()
        {
            String r = "";
            r = webServiceDataGrid();
            
            //MessageBox.Show(r);
            
            String[] res = r.Split('*');

            if (res[0].CompareTo("Error") == 0)
            {
                envios[] e = new envios[1];
                e[0] = new envios("---", "---", "---");
                arrList.Add(e[0]);
                datosTabla = 0;
            }
            else
            {
                datosTabla = 1;
                String[] datosEnvios = res[1].Split(',');
                int tamanio = datosEnvios.Length - 1;
                e = new envios[tamanio];
                for (int i = 0, j = 0; i < tamanio / 3; i++)
                {
                    e[i] = new envios(datosEnvios[j], datosEnvios[j + 1], datosEnvios[j + 2]);
                    j += 3;
                    arrList.Add(e[i]);
                }
            }
            dataGrid1.DataSource = arrList;
            dataGrid1.Refresh();
        }


        public String webServiceConeccion(int a, int b, int c)
        {
            string uriEnvios = Program.uri + "envios.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=" + a + "," + b + "," + c);
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
                return "";
            }
        }

        public String webServiceDataGrid()
        {
            string uriEnvios = Program.uri + "registroEnvios.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=3," + socio + ",1,1," + id_usuario);
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
                return "";
            }
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

        private void close_btn_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        public String datosSocio(int ordenSelected, int carroSelected)
        {
            string regEnvios = Program.uri + "registroEnvios.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=1," + socio + "," + ordenSelected + "," + carroSelected);
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
                // return "Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
                return "";
            }
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (orden_cb.SelectedItem.ToString().CompareTo("") != 0 &&
                 orden_cb.SelectedItem.ToString().CompareTo("Sin ordenes aprobadas") != 0 &&
                  carro_cb.SelectedItem.ToString().CompareTo("") != 0 &&
                   carro_cb.SelectedItem.ToString().CompareTo("Sin carros") != 0)
            {
                String[] res;
                int ordenSelected, carroSelected, id_dist;
                string nombre_dist;


                ordenSelected = int.Parse(orden_cb.SelectedItem.ToString());
                carroSelected = int.Parse(carro_cb.SelectedItem.ToString());

                using (cargando c = new cargando())
                {
                    c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                    c.Show();
                    c.Update();
                    // string[] datosDistribuidor = jsonString.Split(',');
                    string[] datosDistribuidor = datosSocio(ordenSelected, carroSelected).Split(',');
                    id_dist = int.Parse(datosDistribuidor[0]);
                    nombre_dist = datosDistribuidor[1];

                    /*VERIFICA SI LO QUE DEVOLVIO EL WEBSERVER FUE O NO ERROR*/
                    res = registroEnvio(ordenSelected, carroSelected, id_dist).Split('*');
                }

                if (res[0].CompareTo("Error") == 0)
                {
                    MessageBox.Show(res[1], "Error");
                }
                else
                {
                    MessageBox.Show(res[1], "Registro Exitoso");
                    using (readEpcs inventario = new readEpcs(socio, id_socio, ordenSelected, carroSelected, nombre_dist, id_usuario))
                    {
                        this.Close();
                        inventario.ShowDialog();
                        
                    }
                }
                
                  
            }else   
                MessageBox.Show("Debe elegir una orden y un carro disponible.","Error");
        }

        public String registroEnvio(int ordenSelected, int carroSelected, int id_dist)
        {
            string regEnvios = Program.uri + "registroEnvios.php";
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

                postBytes = Encoding.UTF8.GetBytes("datos=2," + socio + "," + ordenSelected + "," + carroSelected + "," + id_dist + "," + id_usuario);
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

        private void dataGrid1_CurrentCellChanged(object sender, EventArgs e)
        {
            if (datosTabla == 1)
            {
                dataGrid1.Select(dataGrid1.CurrentRowIndex);
                envios k = this.e[dataGrid1.CurrentRowIndex];
                preIdEnvio = int.Parse(k.id_envio);
                preIdOrden = int.Parse(k.id_orden);
                preIdCarro = int.Parse(k.id_carro);
                //MessageBox.Show(k.id_envio+","+ k.id_orden+","+k.id_carro);

                cont_btn.Enabled = true;
                elim_btn.Enabled = true;
                env_btn.Enabled = true;
            }
        }

        private void cont_btn_Click(object sender, EventArgs e)
        {
            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                string[] datosDistribuidor = datosSocio(preIdOrden, preIdCarro).Split(',');
                int id_dist = int.Parse(datosDistribuidor[0]);
                string nombre_dist = datosDistribuidor[1];

                using (readEpcs inventario = new readEpcs(socio, id_socio, preIdOrden, preIdCarro, nombre_dist, id_usuario))
                {
                    inventario.ShowDialog();
                    this.Close();
                }
            }

        }

        private void elim_btn_Click(object sender, EventArgs e)
        {
            //MessageBox.Show("¿Seguro que desea eliminar el envio?","¡Advertencia!",MessageBoxButtons.YesNo);
            this.Close();
            using (mensajeShow mensaje = new mensajeShow("¿Seguro que deseas eliminar el pre-envio: "+preIdEnvio+" de la orden: "+preIdOrden+" ? \n - Si lo elimina también eliminará todas las cajas y tarimas que haya registrado en el envio","¡Advertencia!", preIdEnvio, socio, preIdCarro, this, id_socio, id_usuario))
            {  
                mensaje.Location = new Point( (320 - mensaje.Width) / 2, (240-mensaje.Height) / 2);
                mensaje.ShowDialog();
            }
        }

        private void env_btn_Click(object sender, EventArgs e)
        {
            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                String result = finalizarPreEnvio();
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

                postBytes = Encoding.UTF8.GetBytes("datos=" + socio + "," + preIdCarro + "," + preIdOrden);
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

    }

    public class envios
    {
        public envios(string id_envio, string id_carro, string id_orden)
        {
            this.id_envio = id_envio;
            this.id_orden = id_orden;
            this.id_carro = id_carro;
        }

        public string id_envio { get; set; }
        public string id_orden { get; set; }
        public string id_carro { get; set; }
    }

}