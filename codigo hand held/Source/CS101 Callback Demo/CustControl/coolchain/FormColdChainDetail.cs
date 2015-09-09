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
    public partial class FormColdChainDetail : Form
    {
        public FormColdChainDetail()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void FormEM4325Detail_Load(object sender, EventArgs e)
        {
            this.Width = 296;
            this.Height = 190;
        }
    }
}