namespace CS101_CALLBACK_API_DEMO
{
    partial class showPallets
    {
        /// <summary>
        /// Variable del diseñador requerida.
        /// </summary>
        private System.ComponentModel.IContainer components = null;
        private System.Windows.Forms.MainMenu mainMenu1;

        /// <summary>
        /// Limpiar los recursos que se estén usando.
        /// </summary>
        /// <param name="disposing">true si los recursos administrados se deben eliminar; en caso contrario, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Código generado por el Diseñador de Windows Forms

        /// <summary>
        /// Método necesario para admitir el Diseñador. No se puede modificar
        /// el contenido del método con el editor de código.
        /// </summary>
        private void InitializeComponent()
        {
            this.mainMenu1 = new System.Windows.Forms.MainMenu();
            this.dataGrid1 = new System.Windows.Forms.DataGrid();
            this.label3 = new System.Windows.Forms.Label();
            this.envioNumber = new System.Windows.Forms.Label();
            this.button1 = new System.Windows.Forms.Button();
            this.verCajasbtn = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // dataGrid1
            // 
            this.dataGrid1.BackgroundColor = System.Drawing.Color.FromArgb(((int)(((byte)(128)))), ((int)(((byte)(128)))), ((int)(((byte)(128)))));
            this.dataGrid1.Location = new System.Drawing.Point(4, 26);
            this.dataGrid1.Name = "dataGrid1";
            this.dataGrid1.RowHeadersVisible = false;
            this.dataGrid1.Size = new System.Drawing.Size(313, 178);
            this.dataGrid1.TabIndex = 0;
            this.dataGrid1.CurrentCellChanged += new System.EventHandler(this.dataGrid1_CurrentCellChanged);
            // 
            // label3
            // 
            this.label3.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label3.Location = new System.Drawing.Point(5, 4);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(203, 20);
            this.label3.Text = "Pallets del Número de envio:";
            // 
            // envioNumber
            // 
            this.envioNumber.Location = new System.Drawing.Point(214, 4);
            this.envioNumber.Name = "envioNumber";
            this.envioNumber.Size = new System.Drawing.Size(100, 20);
            this.envioNumber.Text = "envioNumber";
            // 
            // button1
            // 
            this.button1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.button1.Location = new System.Drawing.Point(243, 208);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(71, 27);
            this.button1.TabIndex = 5;
            this.button1.Text = "Atras";
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // verCajasbtn
            // 
            this.verCajasbtn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.verCajasbtn.Location = new System.Drawing.Point(5, 208);
            this.verCajasbtn.Name = "verCajasbtn";
            this.verCajasbtn.Size = new System.Drawing.Size(87, 27);
            this.verCajasbtn.TabIndex = 8;
            this.verCajasbtn.Text = "Ver cajas";
            this.verCajasbtn.Click += new System.EventHandler(this.verCajasbtn_Click);
            // 
            // showPallets
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.AutoScroll = true;
            this.ClientSize = new System.Drawing.Size(320, 240);
            this.ControlBox = false;
            this.Controls.Add(this.verCajasbtn);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.envioNumber);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.dataGrid1);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "showPallets";
            this.Text = "showPallets";
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.DataGrid dataGrid1;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label envioNumber;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.Button verCajasbtn;
    }
}