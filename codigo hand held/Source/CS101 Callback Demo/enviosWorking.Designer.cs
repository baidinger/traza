namespace CS101_CALLBACK_API_DEMO
{
    partial class enviosWorking
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
            this.close_btn = new System.Windows.Forms.Button();
            this.label1 = new System.Windows.Forms.Label();
            this.dataGrid1 = new System.Windows.Forms.DataGrid();
            this.cont_btn = new System.Windows.Forms.Button();
            this.elim_btn = new System.Windows.Forms.Button();
            this.env_btn = new System.Windows.Forms.Button();
            this.panel1 = new System.Windows.Forms.Panel();
            this.button4 = new System.Windows.Forms.Button();
            this.carro_cb = new System.Windows.Forms.ComboBox();
            this.label3 = new System.Windows.Forms.Label();
            this.orden_cb = new System.Windows.Forms.ComboBox();
            this.label2 = new System.Windows.Forms.Label();
            this.actualizar_btn = new System.Windows.Forms.Button();
            this.panel1.SuspendLayout();
            this.SuspendLayout();
            // 
            // close_btn
            // 
            this.close_btn.BackColor = System.Drawing.Color.Red;
            this.close_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.close_btn.Location = new System.Drawing.Point(242, 3);
            this.close_btn.Name = "close_btn";
            this.close_btn.Size = new System.Drawing.Size(72, 21);
            this.close_btn.TabIndex = 0;
            this.close_btn.Text = "Atras";
            this.close_btn.Click += new System.EventHandler(this.close_btn_Click);
            // 
            // label1
            // 
            this.label1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label1.Location = new System.Drawing.Point(4, 4);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(136, 20);
            this.label1.Text = "Envios pendientes";
            // 
            // dataGrid1
            // 
            this.dataGrid1.BackgroundColor = System.Drawing.Color.FromArgb(((int)(((byte)(128)))), ((int)(((byte)(128)))), ((int)(((byte)(128)))));
            this.dataGrid1.Location = new System.Drawing.Point(4, 28);
            this.dataGrid1.Name = "dataGrid1";
            this.dataGrid1.Size = new System.Drawing.Size(311, 87);
            this.dataGrid1.TabIndex = 2;
            this.dataGrid1.CurrentCellChanged += new System.EventHandler(this.dataGrid1_CurrentCellChanged);
            // 
            // cont_btn
            // 
            this.cont_btn.BackColor = System.Drawing.Color.DodgerBlue;
            this.cont_btn.Enabled = false;
            this.cont_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.cont_btn.Location = new System.Drawing.Point(4, 119);
            this.cont_btn.Name = "cont_btn";
            this.cont_btn.Size = new System.Drawing.Size(92, 20);
            this.cont_btn.TabIndex = 3;
            this.cont_btn.Text = "continuar";
            this.cont_btn.Click += new System.EventHandler(this.cont_btn_Click);
            // 
            // elim_btn
            // 
            this.elim_btn.BackColor = System.Drawing.Color.Crimson;
            this.elim_btn.Enabled = false;
            this.elim_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.elim_btn.Location = new System.Drawing.Point(112, 118);
            this.elim_btn.Name = "elim_btn";
            this.elim_btn.Size = new System.Drawing.Size(92, 20);
            this.elim_btn.TabIndex = 4;
            this.elim_btn.Text = "Eliminar";
            this.elim_btn.Click += new System.EventHandler(this.elim_btn_Click);
            // 
            // env_btn
            // 
            this.env_btn.BackColor = System.Drawing.Color.DodgerBlue;
            this.env_btn.Enabled = false;
            this.env_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.env_btn.Location = new System.Drawing.Point(223, 118);
            this.env_btn.Name = "env_btn";
            this.env_btn.Size = new System.Drawing.Size(92, 20);
            this.env_btn.TabIndex = 5;
            this.env_btn.Text = "Enviar";
            this.env_btn.Click += new System.EventHandler(this.env_btn_Click);
            // 
            // panel1
            // 
            this.panel1.BackColor = System.Drawing.Color.SeaShell;
            this.panel1.Controls.Add(this.button4);
            this.panel1.Controls.Add(this.carro_cb);
            this.panel1.Controls.Add(this.label3);
            this.panel1.Controls.Add(this.orden_cb);
            this.panel1.Controls.Add(this.label2);
            this.panel1.Location = new System.Drawing.Point(4, 146);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(310, 91);
            // 
            // button4
            // 
            this.button4.BackColor = System.Drawing.Color.DarkCyan;
            this.button4.Font = new System.Drawing.Font("Tahoma", 9F, System.Drawing.FontStyle.Bold);
            this.button4.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.button4.Location = new System.Drawing.Point(207, 4);
            this.button4.Name = "button4";
            this.button4.Size = new System.Drawing.Size(100, 84);
            this.button4.TabIndex = 4;
            this.button4.Text = "Nuevo envio";
            this.button4.Click += new System.EventHandler(this.button4_Click);
            // 
            // carro_cb
            // 
            this.carro_cb.Location = new System.Drawing.Point(76, 50);
            this.carro_cb.Name = "carro_cb";
            this.carro_cb.Size = new System.Drawing.Size(127, 23);
            this.carro_cb.TabIndex = 3;
            // 
            // label3
            // 
            this.label3.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label3.Location = new System.Drawing.Point(4, 55);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(59, 20);
            this.label3.Text = "Carro:";
            // 
            // orden_cb
            // 
            this.orden_cb.Items.Add("1");
            this.orden_cb.Items.Add("2");
            this.orden_cb.Items.Add("3");
            this.orden_cb.Items.Add("4");
            this.orden_cb.Items.Add("5");
            this.orden_cb.Items.Add("6");
            this.orden_cb.Items.Add("7");
            this.orden_cb.Location = new System.Drawing.Point(76, 13);
            this.orden_cb.Name = "orden_cb";
            this.orden_cb.Size = new System.Drawing.Size(127, 23);
            this.orden_cb.TabIndex = 1;
            // 
            // label2
            // 
            this.label2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label2.Location = new System.Drawing.Point(4, 16);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(75, 20);
            this.label2.Text = "N° orden:";
            // 
            // actualizar_btn
            // 
            this.actualizar_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.actualizar_btn.Location = new System.Drawing.Point(147, 4);
            this.actualizar_btn.Name = "actualizar_btn";
            this.actualizar_btn.Size = new System.Drawing.Size(89, 20);
            this.actualizar_btn.TabIndex = 7;
            this.actualizar_btn.Text = "Actualizar";
            this.actualizar_btn.Click += new System.EventHandler(this.actualizar_btn_Click);
            // 
            // enviosWorking
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.ClientSize = new System.Drawing.Size(318, 240);
            this.ControlBox = false;
            this.Controls.Add(this.actualizar_btn);
            this.Controls.Add(this.panel1);
            this.Controls.Add(this.env_btn);
            this.Controls.Add(this.elim_btn);
            this.Controls.Add(this.cont_btn);
            this.Controls.Add(this.dataGrid1);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.close_btn);
            this.Font = new System.Drawing.Font("Arial", 9F, System.Drawing.FontStyle.Regular);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "enviosWorking";
            this.Text = "Control de envios";
            this.panel1.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button close_btn;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.DataGrid dataGrid1;
        private System.Windows.Forms.Button cont_btn;
        private System.Windows.Forms.Button elim_btn;
        private System.Windows.Forms.Button env_btn;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button button4;
        private System.Windows.Forms.ComboBox carro_cb;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.ComboBox orden_cb;
        private System.Windows.Forms.Button actualizar_btn;

    }
}