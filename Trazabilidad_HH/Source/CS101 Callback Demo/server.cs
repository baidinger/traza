using System;
using System.Linq;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using System.IO;

namespace CS101_CALLBACK_API_DEMO
{
    public partial class server : Form
    {
        public server()
        {
            InitializeComponent();

            if (File.Exists("host.txt"))
            {
                using (FileStream fs = new FileStream("host.txt", FileMode.Open))
                using (StreamReader sr = new StreamReader(fs))
                {
                    String host = sr.ReadLine();
                    sr.Close();

                    host_lbl.Text = host;
                }

            }

        }

        private void button1_Click(object sender, EventArgs e)
        {
            using (FileStream fs = new FileStream("host.txt", FileMode.Open))
            using (StreamWriter sw = new StreamWriter(fs))
            {
                sw.WriteLine(host_lbl.Text);
                sw.Flush();
                Program.uri = "http://" + host_lbl.Text + "/traza/webservice/";
                MessageBox.Show("Nuevo Host guardado exitosamente.","Cambio exitoso");
            }

            this.Close();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}