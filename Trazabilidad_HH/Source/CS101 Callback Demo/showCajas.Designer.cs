namespace CS101_CALLBACK_API_DEMO
{
    partial class showCajas
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
            this.label1 = new System.Windows.Forms.Label();
            this.palet_lbl = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.orden_lbl = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.envio_lbl = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.carro_lbl = new System.Windows.Forms.Label();
            this.button1 = new System.Windows.Forms.Button();
            this.traza_btn = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // dataGrid1
            // 
            this.dataGrid1.BackgroundColor = System.Drawing.Color.FromArgb(((int)(((byte)(128)))), ((int)(((byte)(128)))), ((int)(((byte)(128)))));
            this.dataGrid1.Location = new System.Drawing.Point(4, 45);
            this.dataGrid1.Name = "dataGrid1";
            this.dataGrid1.Size = new System.Drawing.Size(313, 159);
            this.dataGrid1.TabIndex = 0;
            this.dataGrid1.CurrentCellChanged += new System.EventHandler(this.dataGrid1_CurrentCellChanged);
            // 
            // label1
            // 
            this.label1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label1.Location = new System.Drawing.Point(4, 4);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(51, 20);
            this.label1.Text = "Palet";
            // 
            // palet_lbl
            // 
            this.palet_lbl.Font = new System.Drawing.Font("Tahoma", 8F, System.Drawing.FontStyle.Regular);
            this.palet_lbl.Location = new System.Drawing.Point(47, 5);
            this.palet_lbl.Name = "palet_lbl";
            this.palet_lbl.Size = new System.Drawing.Size(148, 20);
            this.palet_lbl.Text = "palet_lbl";
            // 
            // label2
            // 
            this.label2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label2.Location = new System.Drawing.Point(204, 4);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(47, 20);
            this.label2.Text = "Orden";
            // 
            // orden_lbl
            // 
            this.orden_lbl.Location = new System.Drawing.Point(258, 4);
            this.orden_lbl.Name = "orden_lbl";
            this.orden_lbl.Size = new System.Drawing.Size(59, 20);
            this.orden_lbl.Text = "orden_lbl";
            // 
            // label3
            // 
            this.label3.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label3.Location = new System.Drawing.Point(4, 23);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(51, 20);
            this.label3.Text = "Envio";
            // 
            // envio_lbl
            // 
            this.envio_lbl.Location = new System.Drawing.Point(50, 23);
            this.envio_lbl.Name = "envio_lbl";
            this.envio_lbl.Size = new System.Drawing.Size(57, 20);
            this.envio_lbl.Text = "envio_lbl";
            // 
            // label4
            // 
            this.label4.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label4.Location = new System.Drawing.Point(204, 22);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(48, 20);
            this.label4.Text = "Carro";
            // 
            // carro_lbl
            // 
            this.carro_lbl.Location = new System.Drawing.Point(259, 23);
            this.carro_lbl.Name = "carro_lbl";
            this.carro_lbl.Size = new System.Drawing.Size(58, 20);
            this.carro_lbl.Text = "carro_lbl";
            // 
            // button1
            // 
            this.button1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.button1.Location = new System.Drawing.Point(243, 208);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(72, 29);
            this.button1.TabIndex = 9;
            this.button1.Text = "Atras";
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // traza_btn
            // 
            this.traza_btn.Enabled = false;
            this.traza_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.traza_btn.Location = new System.Drawing.Point(4, 208);
            this.traza_btn.Name = "traza_btn";
            this.traza_btn.Size = new System.Drawing.Size(118, 29);
            this.traza_btn.TabIndex = 10;
            this.traza_btn.Text = "Ver Trazabilidad";
            // 
            // showCajas
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.AutoScroll = true;
            this.ClientSize = new System.Drawing.Size(320, 240);
            this.ControlBox = false;
            this.Controls.Add(this.traza_btn);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.carro_lbl);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.envio_lbl);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.orden_lbl);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.palet_lbl);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.dataGrid1);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "showCajas";
            this.Text = "showCajas";
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.DataGrid dataGrid1;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label palet_lbl;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label orden_lbl;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label envio_lbl;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label carro_lbl;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.Button traza_btn;
    }
}