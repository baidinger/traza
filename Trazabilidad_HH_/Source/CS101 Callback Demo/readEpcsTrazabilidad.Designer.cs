namespace CS101_CALLBACK_API_DEMO
{
    partial class readEpcsTrazabilidad
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
            this.epc_lbl = new System.Windows.Forms.Label();
            this.button1 = new System.Windows.Forms.Button();
            this.button2 = new System.Windows.Forms.Button();
            this.label1 = new System.Windows.Forms.Label();
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
            this.nTable.Location = new System.Drawing.Point(0, 22);
            this.nTable.MultipleSelection = false;
            this.nTable.Name = "nTable";
            this.nTable.SelectionBackColor = System.Drawing.Color.DarkOrange;
            this.nTable.SelectionForeColor = System.Drawing.Color.Black;
            this.nTable.ShowSplitterValue = true;
            this.nTable.ShowStartSplitter = true;
            this.nTable.Size = new System.Drawing.Size(320, 182);
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
            // epc_lbl
            // 
            this.epc_lbl.Font = new System.Drawing.Font("Tahoma", 8F, System.Drawing.FontStyle.Regular);
            this.epc_lbl.Location = new System.Drawing.Point(4, 214);
            this.epc_lbl.Name = "epc_lbl";
            this.epc_lbl.Size = new System.Drawing.Size(181, 15);
            // 
            // button1
            // 
            this.button1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.button1.Location = new System.Drawing.Point(193, 210);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(124, 23);
            this.button1.TabIndex = 6;
            this.button1.Text = "Ver trazabilidad";
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // button2
            // 
            this.button2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.button2.Location = new System.Drawing.Point(243, 1);
            this.button2.Name = "button2";
            this.button2.Size = new System.Drawing.Size(72, 20);
            this.button2.TabIndex = 8;
            this.button2.Text = "Atras";
            this.button2.Click += new System.EventHandler(this.button2_Click);
            // 
            // label1
            // 
            this.label1.Location = new System.Drawing.Point(3, 1);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(212, 17);
            this.label1.Text = "Leer epcs para la trazabilidad";
            // 
            // readEpcsTrazabilidad
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.BackColor = System.Drawing.SystemColors.Info;
            this.ClientSize = new System.Drawing.Size(320, 240);
            this.ControlBox = false;
            this.Controls.Add(this.label1);
            this.Controls.Add(this.button2);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.epc_lbl);
            this.Controls.Add(this.nTable);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "readEpcsTrazabilidad";
            this.Load += new System.EventHandler(this.SearchForm_Load);
            this.Closing += new System.ComponentModel.CancelEventHandler(this.SearchForm_Closing);
            this.ResumeLayout(false);

        }
        #endregion

        private CSLibrary.Windows.UI.NTable nTable;
        private System.Windows.Forms.Timer tmr_readrate;
        private System.Windows.Forms.Label epc_lbl;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.Button button2;
        private System.Windows.Forms.Label label1;
    }
}

