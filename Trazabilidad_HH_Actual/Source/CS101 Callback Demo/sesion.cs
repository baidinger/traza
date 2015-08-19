using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Windows.Forms;
using System.Data.SqlServerCe;

namespace CS101_CALLBACK_API_DEMO
{
    public partial class sesion : Form
    {
        public sesion()
        {
            InitializeComponent();
             
            
            //Close SplashScreen
      //      CSLibrary.Windows.UI.SplashScreen.Stop();
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

        private void sesion_Load(object sender, EventArgs e)
        {

        }

        private void ini_sesion_btn_Click(object sender, EventArgs e)
        {
            String user, pass, result="";

            user = user_txt.Text;
            pass = pass_txt.Text;

            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                result = webServiceConeccion(user, pass);

            }
            String[] conex = result.Split('*');

            if (conex[0].Contains("Error"))
            {
                MessageBox.Show(conex[1], "Error");
            }
            else
            {
                using (workingPlace wp = new workingPlace(conex[1], user, pass))
                {
                    pass_txt.Text = "";
                    //MessageBox.Show(conex[1]);
                    wp.ShowDialog();
                }
            }


        }

        public static String webServiceConeccion(String a, String b)
        {
            string uriSesion = Program.uri + "sesion.php";
            HttpWebRequest request;
            byte[] postBytes;
        //    CookieManager cookieManager = new CookieManager();
            Stream requestStream;
            HttpWebResponse response;
            Stream responseStream;
            
            try
            {
                /*PETICIÓN AL WEBSERVER*/
                request = (HttpWebRequest)WebRequest.Create(uriSesion);
                request.Method = "POST";
                request.KeepAlive = false;
                request.ProtocolVersion = HttpVersion.Version10;

                postBytes = Encoding.UTF8.GetBytes("datos="+a+","+b);
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
                    //MessageBox.Show(jsonString);
                    reader2.Close();
                }
                responseStream.Close();
                response.Close();

                return jsonString;

            }catch(Exception e2){
                return "Error*Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            using (server s = new server())
            {
                s.Location = new Point((320 - s.Width) / 2, (240 - s.Height) / 2);
                s.ShowDialog();
            }
        }
    }


}