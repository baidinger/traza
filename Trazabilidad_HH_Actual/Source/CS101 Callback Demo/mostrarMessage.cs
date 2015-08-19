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
    public partial class mostrarMessage : Form
    {
        public mostrarMessage(String title, String question, String info)
        {
            InitializeComponent();

            this.Text = title;
            this.pregunta_lbl.Text = question;
            this.info_lbl.Text = info;
        }

        public mostrarMessage(String title, String question)
        {
            new mostrarMessage(title, question, "");
        }

        private void button1_Click(object sender, EventArgs e)
        {
            DialogResult = DialogResult.OK;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}