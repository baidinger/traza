using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

using System;
using System.Threading;

namespace CS101_CALLBACK_API_DEMO
{
    public partial class BarCodeMessage : Form
    {
        public BarCodeMessage()
        {
            InitializeComponent();
        }

        private void BarCodeMessage_Load(object sender, EventArgs e)
        {
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}