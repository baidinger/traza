using System;
using System.Linq;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;


namespace CS101_CALLBACK_API_DEMO
{
    public partial class workingPlace : Form
    {
        public int socio, id_socio, id_usuario;
        public workingPlace(String result, String user, String pass)
        {
            InitializeComponent();
            //MessageBox.Show(result);
            string[] datos = result.Split(',');

            tipo_socio_lbl.Text = datos[9];
           // id_socio_lbl.Text = datos[7];
            nombre_usuario_lbl.Text = datos[0] + " - " + datos[1];
            nombre_apellido_lbl.Text = datos[4] + " - " + datos[5] + " " + datos[6];
            nombre_empaque_lbl.Text = datos[7] + " - " + datos[8];

            id_usuario = int.Parse(datos[4]);
            socio = int.Parse(datos[2]);
            id_socio = int.Parse(datos[7]);
            switch(socio){
               case 1:
                break;
               case 2:
                    label2.Text = "Nombre del empaque:";
                    recibos_btn.Enabled = false;
                break;
               case 3:
                    label2.Text = "Nombre del distribuidor:";
                break;
               case 4:
                    label2.Text = "Nombre del punto de venta:";
                break;
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

        private void workingPlace_Load(object sender, EventArgs e)
        {

        }

        private void label2_ParentChanged(object sender, EventArgs e)
        {

        }

        private void label5_ParentChanged(object sender, EventArgs e)
        {

        }

        private void salir_btn_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void envios_btn_Click(object sender, EventArgs e)
        {

            using (enviosWorking en = new enviosWorking(socio, id_socio, id_usuario))
            {
                en.ShowDialog();
            }
        }

        private void nombre_empaque_lbl_ParentChanged(object sender, EventArgs e)
        {

        }

        private void recibos_btn_Click(object sender, EventArgs e)
        {
            using (entradasWorgking eW = new entradasWorgking(socio, id_socio, id_usuario))
            {
                eW.ShowDialog();
            }
        }
    }
}