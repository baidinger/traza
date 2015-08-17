namespace CS101_CALLBACK_API_DEMO
{
    partial class readEpcsEntradas
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
            this.nTable = new CSLibrary.Windows.UI.NTable();
            this.tmr_readrate = new System.Windows.Forms.Timer();
            this.panel1 = new System.Windows.Forms.Panel();
            this.dest_lbl = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.socio_lbl = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.cajas_lbl = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.tarima_lbl = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.id_carro_lbl = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.id_orden_lbl = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.startMenu1 = new CS101_CALLBACK_API_DEMO.StartMenu();
            this.panel1.SuspendLayout();
            this.SuspendLayout();
            // 
            // nTable
            // 
            this.nTable.AllowColumnResize = false;
            this.nTable.AltBackColor = System.Drawing.Color.Khaki;
            this.nTable.AltForeColor = System.Drawing.Color.Black;
            this.nTable.AutoColumnSize = true;
            this.nTable.AutoMoveRow = false;
            this.nTable.BorderColor = System.Drawing.Color.FromArgb(((int)(((byte)(224)))), ((int)(((byte)(224)))), ((int)(((byte)(224)))));
            this.nTable.ColumnBackColor = System.Drawing.Color.Chocolate;
            this.nTable.ColumnFont = new System.Drawing.Font("Tahoma", 9.75F, System.Drawing.FontStyle.Bold);
            this.nTable.ColumnForeColor = System.Drawing.Color.White;
            this.nTable.DefaultLineAligment = System.Drawing.StringAlignment.Center;
            this.nTable.DefaultRowHeight = 20;
            this.nTable.DefaultTextAligment = System.Drawing.StringAlignment.Center;
            this.nTable.DrawGridBorder = true;
            this.nTable.FocusCellBackColor = System.Drawing.Color.DarkOrange;
            this.nTable.FocusCellForeColor = System.Drawing.Color.Black;
            this.nTable.LeftHeader = false;
            this.nTable.Location = new System.Drawing.Point(0, 77);
            this.nTable.MultipleSelection = false;
            this.nTable.Name = "nTable";
            this.nTable.SelectionBackColor = System.Drawing.Color.DarkOrange;
            this.nTable.SelectionForeColor = System.Drawing.Color.Black;
            this.nTable.ShowSplitterValue = true;
            this.nTable.ShowStartSplitter = true;
            this.nTable.Size = new System.Drawing.Size(320, 101);
            this.nTable.SplitterColor = System.Drawing.Color.Red;
            this.nTable.SplitterMode = CSLibrary.Windows.UI.NTableSplitterMode.Default;
            this.nTable.SplitterStartColor = System.Drawing.Color.Brown;
            this.nTable.SplitterWidth = 1;
            this.nTable.TabIndex = 4;
            this.nTable.Text = "nTable1";
            this.nTable.Click += new System.EventHandler(this.nTable_Click);
            this.nTable.RowChanged += new CSLibrary.Windows.UI.NTableRowHandler(this.nTable_RowChanged);
            // 
            // tmr_readrate
            // 
            this.tmr_readrate.Interval = 1000;
            this.tmr_readrate.Tick += new System.EventHandler(this.tmr_readrate_Tick);
            // 
            // panel1
            // 
            this.panel1.Controls.Add(this.dest_lbl);
            this.panel1.Controls.Add(this.label6);
            this.panel1.Controls.Add(this.socio_lbl);
            this.panel1.Controls.Add(this.label2);
            this.panel1.Controls.Add(this.cajas_lbl);
            this.panel1.Controls.Add(this.label5);
            this.panel1.Controls.Add(this.tarima_lbl);
            this.panel1.Controls.Add(this.label4);
            this.panel1.Controls.Add(this.id_carro_lbl);
            this.panel1.Controls.Add(this.label3);
            this.panel1.Controls.Add(this.id_orden_lbl);
            this.panel1.Controls.Add(this.label1);
            this.panel1.Location = new System.Drawing.Point(2, 2);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(315, 75);
            // 
            // dest_lbl
            // 
            this.dest_lbl.Location = new System.Drawing.Point(45, 56);
            this.dest_lbl.Name = "dest_lbl";
            this.dest_lbl.Size = new System.Drawing.Size(267, 20);
            this.dest_lbl.Text = "dest_lbl";
            // 
            // label6
            // 
            this.label6.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label6.Location = new System.Drawing.Point(4, 55);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(41, 20);
            this.label6.Text = "Para:";
            // 
            // socio_lbl
            // 
            this.socio_lbl.Location = new System.Drawing.Point(29, 36);
            this.socio_lbl.Name = "socio_lbl";
            this.socio_lbl.Size = new System.Drawing.Size(193, 20);
            this.socio_lbl.Text = "socio_lbl";
            // 
            // label2
            // 
            this.label2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label2.Location = new System.Drawing.Point(4, 36);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(32, 20);
            this.label2.Text = "De:";
            // 
            // cajas_lbl
            // 
            this.cajas_lbl.Location = new System.Drawing.Point(285, 38);
            this.cajas_lbl.Name = "cajas_lbl";
            this.cajas_lbl.Size = new System.Drawing.Size(28, 20);
            this.cajas_lbl.Text = "000";
            // 
            // label5
            // 
            this.label5.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label5.Location = new System.Drawing.Point(228, 37);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(70, 20);
            this.label5.Text = "Cajas:";
            // 
            // tarima_lbl
            // 
            this.tarima_lbl.Location = new System.Drawing.Point(286, 21);
            this.tarima_lbl.Name = "tarima_lbl";
            this.tarima_lbl.Size = new System.Drawing.Size(38, 20);
            this.tarima_lbl.Text = "000";
            // 
            // label4
            // 
            this.label4.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label4.Location = new System.Drawing.Point(219, 21);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(71, 20);
            this.label4.Text = "Pallets:";
            // 
            // id_carro_lbl
            // 
            this.id_carro_lbl.Location = new System.Drawing.Point(246, 4);
            this.id_carro_lbl.Name = "id_carro_lbl";
            this.id_carro_lbl.Size = new System.Drawing.Size(70, 20);
            this.id_carro_lbl.Text = "id_carro_lbl";
            // 
            // label3
            // 
            this.label3.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label3.Location = new System.Drawing.Point(180, 4);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(71, 20);
            this.label3.Text = "N° Carro:";
            // 
            // id_orden_lbl
            // 
            this.id_orden_lbl.Location = new System.Drawing.Point(72, 4);
            this.id_orden_lbl.Name = "id_orden_lbl";
            this.id_orden_lbl.Size = new System.Drawing.Size(62, 20);
            this.id_orden_lbl.Text = "id_orden_lbl";
            // 
            // label1
            // 
            this.label1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label1.Location = new System.Drawing.Point(4, 4);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(100, 20);
            this.label1.Text = "N° Orden:";
            // 
            // startMenu1
            // 
            this.startMenu1.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(192)))), ((int)(((byte)(192)))), ((int)(((byte)(255)))));
            this.startMenu1.IsSelectable = false;
            this.startMenu1.Location = new System.Drawing.Point(0, 178);
            this.startMenu1.Name = "startMenu1";
            this.startMenu1.ShowSortFlag = CS101_CALLBACK_API_DEMO.SlowFlags.NONE;
            this.startMenu1.Size = new System.Drawing.Size(320, 63);
            this.startMenu1.TabIndex = 5;
            this.startMenu1.Click += new System.EventHandler(this.startMenu1_Click);
            this.startMenu1.OnButtonClick += new CS101_CALLBACK_API_DEMO.StartMenu.ButtonClickArgs(this.startMenu1_OnButtonClick);
            // 
            // readEpcs
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.BackColor = System.Drawing.SystemColors.Info;
            this.ClientSize = new System.Drawing.Size(320, 240);
            this.ControlBox = false;
            this.Controls.Add(this.panel1);
            this.Controls.Add(this.startMenu1);
            this.Controls.Add(this.nTable);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "readEpcs";
            this.Load += new System.EventHandler(this.SearchForm_Load);
            this.Closing += new System.ComponentModel.CancelEventHandler(this.SearchForm_Closing);
            this.panel1.ResumeLayout(false);
            this.ResumeLayout(false);

        }
        #endregion

        private CSLibrary.Windows.UI.NTable nTable;
        private StartMenu startMenu1;
        private System.Windows.Forms.Timer tmr_readrate;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Label id_orden_lbl;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label tarima_lbl;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label id_carro_lbl;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label cajas_lbl;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label socio_lbl;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label dest_lbl;
        private System.Windows.Forms.Label label6;
    }
}

