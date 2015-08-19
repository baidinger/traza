namespace CS101_CALLBACK_API_DEMO
{
    partial class entradasWorgking
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
            this.label2 = new System.Windows.Forms.Label();
            this.empaque_lbl = new System.Windows.Forms.Label();
            this.cont = new System.Windows.Forms.Button();
            this.compl_send = new System.Windows.Forms.Button();
            this.button3 = new System.Windows.Forms.Button();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.showPallet = new System.Windows.Forms.Button();
            this.actualizar_btn = new System.Windows.Forms.Button();
            this.rechazar_btn = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // dataGrid1
            // 
            this.dataGrid1.BackgroundColor = System.Drawing.Color.FromArgb(((int)(((byte)(128)))), ((int)(((byte)(128)))), ((int)(((byte)(128)))));
            this.dataGrid1.Location = new System.Drawing.Point(4, 24);
            this.dataGrid1.Name = "dataGrid1";
            this.dataGrid1.Size = new System.Drawing.Size(313, 104);
            this.dataGrid1.TabIndex = 0;
            this.dataGrid1.CurrentCellChanged += new System.EventHandler(this.dataGrid1_CurrentCellChanged);
            // 
            // label1
            // 
            this.label1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label1.Location = new System.Drawing.Point(0, 1);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(134, 20);
            this.label1.Text = "Envios recibidos:";
            // 
            // label2
            // 
            this.label2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label2.Location = new System.Drawing.Point(3, 131);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(35, 20);
            this.label2.Text = "De:";
            this.label2.ParentChanged += new System.EventHandler(this.label2_ParentChanged);
            // 
            // empaque_lbl
            // 
            this.empaque_lbl.Location = new System.Drawing.Point(45, 131);
            this.empaque_lbl.Name = "empaque_lbl";
            this.empaque_lbl.Size = new System.Drawing.Size(271, 20);
            this.empaque_lbl.Text = "---";
            // 
            // cont
            // 
            this.cont.Enabled = false;
            this.cont.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.cont.Location = new System.Drawing.Point(4, 212);
            this.cont.Name = "cont";
            this.cont.Size = new System.Drawing.Size(85, 25);
            this.cont.TabIndex = 4;
            this.cont.Text = "Leer";
            this.cont.Click += new System.EventHandler(this.cont_Click);
            // 
            // compl_send
            // 
            this.compl_send.Enabled = false;
            this.compl_send.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.compl_send.Location = new System.Drawing.Point(207, 212);
            this.compl_send.Name = "compl_send";
            this.compl_send.Size = new System.Drawing.Size(109, 25);
            this.compl_send.TabIndex = 5;
            this.compl_send.Text = "Finalizar envio";
            this.compl_send.Click += new System.EventHandler(this.compl_send_Click);
            // 
            // button3
            // 
            this.button3.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.button3.Location = new System.Drawing.Point(244, 2);
            this.button3.Name = "button3";
            this.button3.Size = new System.Drawing.Size(72, 20);
            this.button3.TabIndex = 6;
            this.button3.Text = "Atras";
            this.button3.Click += new System.EventHandler(this.button3_Click);
            // 
            // label3
            // 
            this.label3.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label3.Location = new System.Drawing.Point(4, 148);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(204, 20);
            this.label3.Text = "N° de pallets enviados:";
            // 
            // label4
            // 
            this.label4.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label4.Location = new System.Drawing.Point(4, 181);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(204, 20);
            this.label4.Text = "N° de pallets llegados:";
            // 
            // label5
            // 
            this.label5.Location = new System.Drawing.Point(164, 150);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(63, 20);
            this.label5.Text = "----";
            // 
            // label6
            // 
            this.label6.Location = new System.Drawing.Point(163, 184);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(63, 20);
            this.label6.Text = "----";
            // 
            // showPallet
            // 
            this.showPallet.Enabled = false;
            this.showPallet.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.showPallet.Location = new System.Drawing.Point(234, 147);
            this.showPallet.Name = "showPallet";
            this.showPallet.Size = new System.Drawing.Size(83, 47);
            this.showPallet.TabIndex = 14;
            this.showPallet.Text = "Ver pallets";
            this.showPallet.Click += new System.EventHandler(this.showPallet_Click);
            // 
            // actualizar_btn
            // 
            this.actualizar_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.actualizar_btn.Location = new System.Drawing.Point(166, 2);
            this.actualizar_btn.Name = "actualizar_btn";
            this.actualizar_btn.Size = new System.Drawing.Size(72, 20);
            this.actualizar_btn.TabIndex = 15;
            this.actualizar_btn.Text = "Actualizar";
            this.actualizar_btn.Click += new System.EventHandler(this.button1_Click);
            // 
            // rechazar_btn
            // 
            this.rechazar_btn.Enabled = false;
            this.rechazar_btn.Font = new System.Drawing.Font("Tahoma", 9F, System.Drawing.FontStyle.Bold);
            this.rechazar_btn.Location = new System.Drawing.Point(96, 212);
            this.rechazar_btn.Name = "rechazar_btn";
            this.rechazar_btn.Size = new System.Drawing.Size(105, 25);
            this.rechazar_btn.TabIndex = 23;
            this.rechazar_btn.Text = "Rechazar envio";
            this.rechazar_btn.Click += new System.EventHandler(this.rechazar_btn_Click);
            // 
            // entradasWorgking
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.AutoScroll = true;
            this.ClientSize = new System.Drawing.Size(320, 240);
            this.ControlBox = false;
            this.Controls.Add(this.rechazar_btn);
            this.Controls.Add(this.actualizar_btn);
            this.Controls.Add(this.showPallet);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.button3);
            this.Controls.Add(this.compl_send);
            this.Controls.Add(this.cont);
            this.Controls.Add(this.empaque_lbl);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.dataGrid1);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "entradasWorgking";
            this.Text = "entradasWorgking";
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.DataGrid dataGrid1;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label empaque_lbl;
        private System.Windows.Forms.Button cont;
        private System.Windows.Forms.Button compl_send;
        private System.Windows.Forms.Button button3;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Button showPallet;
        private System.Windows.Forms.Button actualizar_btn;
        private System.Windows.Forms.Button rechazar_btn;
    }
}