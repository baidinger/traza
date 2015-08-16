namespace CS101_CALLBACK_API_DEMO
{
    partial class FormColdChain
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.listView1 = new System.Windows.Forms.ListView();
            this.columnHeader1 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader2 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader3 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader4 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader5 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader6 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader7 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader8 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader9 = new System.Windows.Forms.ColumnHeader();
            this.columnHeader10 = new System.Windows.Forms.ColumnHeader();
            this.btn_start = new System.Windows.Forms.Button();
            this.btn_exit = new System.Windows.Forms.Button();
            this.tabControl1 = new System.Windows.Forms.TabControl();
            this.tabPage1 = new System.Windows.Forms.TabPage();
            this.tabPage2 = new System.Windows.Forms.TabPage();
            this.textBox4 = new System.Windows.Forms.TextBox();
            this.textBox3 = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.textBox2 = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.button2 = new System.Windows.Forms.Button();
            this.button1 = new System.Windows.Forms.Button();
            this.textBox1 = new System.Windows.Forms.TextBox();
            this.tabPage3 = new System.Windows.Forms.TabPage();
            this.tabControl1.SuspendLayout();
            this.tabPage1.SuspendLayout();
            this.tabPage2.SuspendLayout();
            this.SuspendLayout();
            // 
            // listView1
            // 
            this.listView1.Columns.Add(this.columnHeader1);
            this.listView1.Columns.Add(this.columnHeader2);
            this.listView1.Columns.Add(this.columnHeader3);
            this.listView1.Columns.Add(this.columnHeader4);
            this.listView1.Columns.Add(this.columnHeader5);
            this.listView1.Columns.Add(this.columnHeader6);
            this.listView1.Columns.Add(this.columnHeader7);
            this.listView1.Columns.Add(this.columnHeader8);
            this.listView1.Columns.Add(this.columnHeader9);
            this.listView1.Columns.Add(this.columnHeader10);
            this.listView1.Location = new System.Drawing.Point(0, 0);
            this.listView1.Name = "listView1";
            this.listView1.Size = new System.Drawing.Size(306, 158);
            this.listView1.TabIndex = 0;
            this.listView1.View = System.Windows.Forms.View.Details;
            this.listView1.SelectedIndexChanged += new System.EventHandler(this.listView1_SelectedIndexChanged);
            // 
            // columnHeader1
            // 
            this.columnHeader1.Text = "EPC";
            this.columnHeader1.Width = 178;
            // 
            // columnHeader2
            // 
            this.columnHeader2.Text = "°C";
            this.columnHeader2.Width = 50;
            // 
            // columnHeader3
            // 
            this.columnHeader3.Text = "T!";
            this.columnHeader3.Width = 30;
            // 
            // columnHeader4
            // 
            this.columnHeader4.Text = "B!";
            this.columnHeader4.Width = 30;
            // 
            // columnHeader5
            // 
            this.columnHeader5.Text = "MSW";
            this.columnHeader5.Width = 0;
            // 
            // columnHeader6
            // 
            this.columnHeader6.Text = "LSW";
            this.columnHeader6.Width = 0;
            // 
            // columnHeader7
            // 
            this.columnHeader7.Text = "UTCMSW";
            this.columnHeader7.Width = 0;
            // 
            // columnHeader8
            // 
            this.columnHeader8.Text = "UTCLSW";
            this.columnHeader8.Width = 0;
            // 
            // columnHeader9
            // 
            this.columnHeader9.Text = "STARTTIMEMSW";
            this.columnHeader9.Width = 0;
            // 
            // columnHeader10
            // 
            this.columnHeader10.Text = "STARTTIMELSW";
            this.columnHeader10.Width = 0;
            // 
            // btn_start
            // 
            this.btn_start.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(0)))), ((int)(((byte)(192)))), ((int)(((byte)(0)))));
            this.btn_start.Font = new System.Drawing.Font("Tahoma", 12F, System.Drawing.FontStyle.Bold);
            this.btn_start.ForeColor = System.Drawing.Color.White;
            this.btn_start.Location = new System.Drawing.Point(49, 168);
            this.btn_start.Name = "btn_start";
            this.btn_start.Size = new System.Drawing.Size(72, 28);
            this.btn_start.TabIndex = 3;
            this.btn_start.Text = "Start";
            this.btn_start.Click += new System.EventHandler(this.btn_start_Click);
            // 
            // btn_exit
            // 
            this.btn_exit.BackColor = System.Drawing.Color.Red;
            this.btn_exit.Font = new System.Drawing.Font("Tahoma", 12F, System.Drawing.FontStyle.Bold);
            this.btn_exit.ForeColor = System.Drawing.Color.White;
            this.btn_exit.Location = new System.Drawing.Point(198, 168);
            this.btn_exit.Name = "btn_exit";
            this.btn_exit.Size = new System.Drawing.Size(72, 28);
            this.btn_exit.TabIndex = 4;
            this.btn_exit.Text = "Exit";
            this.btn_exit.Click += new System.EventHandler(this.btn_exit_Click);
            // 
            // tabControl1
            // 
            this.tabControl1.Controls.Add(this.tabPage1);
            this.tabControl1.Controls.Add(this.tabPage2);
            this.tabControl1.Controls.Add(this.tabPage3);
            this.tabControl1.Location = new System.Drawing.Point(3, 3);
            this.tabControl1.Name = "tabControl1";
            this.tabControl1.SelectedIndex = 0;
            this.tabControl1.Size = new System.Drawing.Size(314, 237);
            this.tabControl1.TabIndex = 7;
            this.tabControl1.SelectedIndexChanged += new System.EventHandler(this.tabControl1_SelectedIndexChanged);
            // 
            // tabPage1
            // 
            this.tabPage1.Controls.Add(this.listView1);
            this.tabPage1.Controls.Add(this.btn_exit);
            this.tabPage1.Controls.Add(this.btn_start);
            this.tabPage1.Location = new System.Drawing.Point(4, 25);
            this.tabPage1.Name = "tabPage1";
            this.tabPage1.Size = new System.Drawing.Size(306, 208);
            this.tabPage1.Text = "EM432x Info";
            // 
            // tabPage2
            // 
            this.tabPage2.Controls.Add(this.textBox4);
            this.tabPage2.Controls.Add(this.textBox3);
            this.tabPage2.Controls.Add(this.label4);
            this.tabPage2.Controls.Add(this.label3);
            this.tabPage2.Controls.Add(this.textBox2);
            this.tabPage2.Controls.Add(this.label2);
            this.tabPage2.Controls.Add(this.label1);
            this.tabPage2.Controls.Add(this.button2);
            this.tabPage2.Controls.Add(this.button1);
            this.tabPage2.Controls.Add(this.textBox1);
            this.tabPage2.Location = new System.Drawing.Point(4, 25);
            this.tabPage2.Name = "tabPage2";
            this.tabPage2.Size = new System.Drawing.Size(306, 208);
            this.tabPage2.Text = "EM4325 Monitor";
            // 
            // textBox4
            // 
            this.textBox4.Location = new System.Drawing.Point(150, 96);
            this.textBox4.Name = "textBox4";
            this.textBox4.Size = new System.Drawing.Size(96, 23);
            this.textBox4.TabIndex = 11;
            this.textBox4.LostFocus += new System.EventHandler(this.textBox4_LostFocus);
            // 
            // textBox3
            // 
            this.textBox3.Location = new System.Drawing.Point(150, 67);
            this.textBox3.Name = "textBox3";
            this.textBox3.Size = new System.Drawing.Size(96, 23);
            this.textBox3.TabIndex = 10;
            this.textBox3.LostFocus += new System.EventHandler(this.textBox3_LostFocus);
            // 
            // label4
            // 
            this.label4.Location = new System.Drawing.Point(8, 96);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(137, 16);
            this.label4.Text = "Over Temp Threshold";
            // 
            // label3
            // 
            this.label3.Location = new System.Drawing.Point(8, 67);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(145, 21);
            this.label3.Text = "Under Temp Threshold";
            // 
            // textBox2
            // 
            this.textBox2.Location = new System.Drawing.Point(80, 32);
            this.textBox2.Name = "textBox2";
            this.textBox2.Size = new System.Drawing.Size(65, 23);
            this.textBox2.TabIndex = 5;
            this.textBox2.Text = "00000000";
            // 
            // label2
            // 
            this.label2.Location = new System.Drawing.Point(8, 32);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(65, 26);
            this.label2.Text = "Password";
            // 
            // label1
            // 
            this.label1.Location = new System.Drawing.Point(8, 3);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(35, 23);
            this.label1.Text = "EPC";
            // 
            // button2
            // 
            this.button2.Location = new System.Drawing.Point(169, 159);
            this.button2.Name = "button2";
            this.button2.Size = new System.Drawing.Size(108, 26);
            this.button2.TabIndex = 2;
            this.button2.Text = "Sensor Disable";
            this.button2.Click += new System.EventHandler(this.button2_Click);
            // 
            // button1
            // 
            this.button1.Location = new System.Drawing.Point(19, 159);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(108, 26);
            this.button1.TabIndex = 1;
            this.button1.Text = "Sensor Enable";
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // textBox1
            // 
            this.textBox1.Location = new System.Drawing.Point(79, 3);
            this.textBox1.Name = "textBox1";
            this.textBox1.Size = new System.Drawing.Size(207, 23);
            this.textBox1.TabIndex = 0;
            // 
            // tabPage3
            // 
            this.tabPage3.Location = new System.Drawing.Point(4, 25);
            this.tabPage3.Name = "tabPage3";
            this.tabPage3.Size = new System.Drawing.Size(306, 208);
            this.tabPage3.Text = "Exit";
            // 
            // FormColdChain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.ClientSize = new System.Drawing.Size(320, 240);
            this.ControlBox = false;
            this.Controls.Add(this.tabControl1);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FormColdChain";
            this.Text = "EM432x Battery Check";
            this.Load += new System.EventHandler(this.FormEM432xBatteryCheck_Load);
            this.Closing += new System.ComponentModel.CancelEventHandler(this.FormEM432xBatteryCheck_Closing);
            this.tabControl1.ResumeLayout(false);
            this.tabPage1.ResumeLayout(false);
            this.tabPage2.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.ListView listView1;
        private System.Windows.Forms.Button btn_start;
        private System.Windows.Forms.ColumnHeader columnHeader1;
        private System.Windows.Forms.ColumnHeader columnHeader2;
        private System.Windows.Forms.ColumnHeader columnHeader3;
        private System.Windows.Forms.Button btn_exit;
        private System.Windows.Forms.TabControl tabControl1;
        private System.Windows.Forms.TabPage tabPage1;
        private System.Windows.Forms.TabPage tabPage2;
        private System.Windows.Forms.TabPage tabPage3;
        private System.Windows.Forms.Button button2;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.TextBox textBox2;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.ColumnHeader columnHeader4;
        private System.Windows.Forms.ColumnHeader columnHeader5;
        private System.Windows.Forms.ColumnHeader columnHeader6;
        private System.Windows.Forms.ColumnHeader columnHeader7;
        private System.Windows.Forms.ColumnHeader columnHeader8;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox textBox1;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.ColumnHeader columnHeader9;
        private System.Windows.Forms.ColumnHeader columnHeader10;
        private System.Windows.Forms.TextBox textBox4;
        private System.Windows.Forms.TextBox textBox3;
    }
}