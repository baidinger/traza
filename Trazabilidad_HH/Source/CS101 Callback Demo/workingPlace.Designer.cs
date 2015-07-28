namespace CS101_CALLBACK_API_DEMO
{
    partial class workingPlace
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
            this.envios_btn = new System.Windows.Forms.Button();
            this.salir_btn = new System.Windows.Forms.Button();
            this.button1 = new System.Windows.Forms.Button();
            this.panel1 = new System.Windows.Forms.Panel();
            this.nombre_apellido_lbl = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.nombre_empaque_lbl = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.nombre_usuario_lbl = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.id_socio_lbl = new System.Windows.Forms.Label();
            this.tipo_socio_lbl = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.recibos_btn = new System.Windows.Forms.Button();
            this.label6 = new System.Windows.Forms.Label();
            this.panel1.SuspendLayout();
            this.SuspendLayout();
            // 
            // envios_btn
            // 
            this.envios_btn.BackColor = System.Drawing.Color.DodgerBlue;
            this.envios_btn.Font = new System.Drawing.Font("Tahoma", 14F, System.Drawing.FontStyle.Bold);
            this.envios_btn.Location = new System.Drawing.Point(10, 141);
            this.envios_btn.Name = "envios_btn";
            this.envios_btn.Size = new System.Drawing.Size(113, 42);
            this.envios_btn.TabIndex = 10;
            this.envios_btn.Text = "Envios";
            this.envios_btn.Click += new System.EventHandler(this.envios_btn_Click);
            // 
            // salir_btn
            // 
            this.salir_btn.BackColor = System.Drawing.Color.Red;
            this.salir_btn.Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);
            this.salir_btn.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.salir_btn.Location = new System.Drawing.Point(161, 191);
            this.salir_btn.Name = "salir_btn";
            this.salir_btn.Size = new System.Drawing.Size(145, 44);
            this.salir_btn.TabIndex = 11;
            this.salir_btn.Text = "Salir de sesión";
            this.salir_btn.Click += new System.EventHandler(this.salir_btn_Click);
            // 
            // button1
            // 
            this.button1.BackColor = System.Drawing.Color.DodgerBlue;
            this.button1.Font = new System.Drawing.Font("Tahoma", 14F, System.Drawing.FontStyle.Bold);
            this.button1.Location = new System.Drawing.Point(161, 141);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(145, 42);
            this.button1.TabIndex = 22;
            this.button1.Text = "Trazabilidad";
            // 
            // panel1
            // 
            this.panel1.Controls.Add(this.nombre_apellido_lbl);
            this.panel1.Controls.Add(this.label4);
            this.panel1.Controls.Add(this.nombre_empaque_lbl);
            this.panel1.Controls.Add(this.label2);
            this.panel1.Controls.Add(this.nombre_usuario_lbl);
            this.panel1.Controls.Add(this.label5);
            this.panel1.Controls.Add(this.id_socio_lbl);
            this.panel1.Controls.Add(this.tipo_socio_lbl);
            this.panel1.Controls.Add(this.label1);
            this.panel1.Location = new System.Drawing.Point(4, 3);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(311, 105);
            // 
            // nombre_apellido_lbl
            // 
            this.nombre_apellido_lbl.Location = new System.Drawing.Point(60, 43);
            this.nombre_apellido_lbl.Name = "nombre_apellido_lbl";
            this.nombre_apellido_lbl.Size = new System.Drawing.Size(249, 20);
            this.nombre_apellido_lbl.Text = "nombre_apellido_lbl";
            // 
            // label4
            // 
            this.label4.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label4.Location = new System.Drawing.Point(1, 43);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(75, 20);
            this.label4.Text = "Nombre:";
            // 
            // nombre_empaque_lbl
            // 
            this.nombre_empaque_lbl.Location = new System.Drawing.Point(13, 76);
            this.nombre_empaque_lbl.Name = "nombre_empaque_lbl";
            this.nombre_empaque_lbl.Size = new System.Drawing.Size(283, 21);
            this.nombre_empaque_lbl.Text = "nombre_empaque_lbl";
            this.nombre_empaque_lbl.ParentChanged += new System.EventHandler(this.nombre_empaque_lbl_ParentChanged);
            // 
            // label2
            // 
            this.label2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label2.Location = new System.Drawing.Point(1, 60);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(198, 20);
            this.label2.Text = "Nombre del empaque:";
            // 
            // nombre_usuario_lbl
            // 
            this.nombre_usuario_lbl.Location = new System.Drawing.Point(60, 26);
            this.nombre_usuario_lbl.Name = "nombre_usuario_lbl";
            this.nombre_usuario_lbl.Size = new System.Drawing.Size(130, 20);
            this.nombre_usuario_lbl.Text = "nombre_usuario_lbl";
            // 
            // label5
            // 
            this.label5.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label5.Location = new System.Drawing.Point(1, 26);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(75, 20);
            this.label5.Text = "Usuario:";
            // 
            // id_socio_lbl
            // 
            this.id_socio_lbl.Location = new System.Drawing.Point(196, 8);
            this.id_socio_lbl.Name = "id_socio_lbl";
            this.id_socio_lbl.Size = new System.Drawing.Size(58, 20);
            this.id_socio_lbl.Text = "id_socio_lbl";
            this.id_socio_lbl.Visible = false;
            // 
            // tipo_socio_lbl
            // 
            this.tipo_socio_lbl.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.tipo_socio_lbl.Location = new System.Drawing.Point(57, 8);
            this.tipo_socio_lbl.Name = "tipo_socio_lbl";
            this.tipo_socio_lbl.Size = new System.Drawing.Size(104, 20);
            this.tipo_socio_lbl.Text = "tipo_socio_lbl";
            // 
            // label1
            // 
            this.label1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label1.Location = new System.Drawing.Point(2, 9);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(51, 20);
            this.label1.Text = "Socio:";
            // 
            // recibos_btn
            // 
            this.recibos_btn.BackColor = System.Drawing.Color.DodgerBlue;
            this.recibos_btn.Font = new System.Drawing.Font("Tahoma", 14F, System.Drawing.FontStyle.Bold);
            this.recibos_btn.Location = new System.Drawing.Point(10, 191);
            this.recibos_btn.Name = "recibos_btn";
            this.recibos_btn.Size = new System.Drawing.Size(113, 44);
            this.recibos_btn.TabIndex = 24;
            this.recibos_btn.Text = "Entregas";
            // 
            // label6
            // 
            this.label6.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label6.Location = new System.Drawing.Point(3, 119);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(317, 20);
            this.label6.Text = "Elige una opción...";
            // 
            // workingPlace
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.ClientSize = new System.Drawing.Size(320, 240);
            this.ControlBox = false;
            this.Controls.Add(this.label6);
            this.Controls.Add(this.recibos_btn);
            this.Controls.Add(this.panel1);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.salir_btn);
            this.Controls.Add(this.envios_btn);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "workingPlace";
            this.Text = "Elige una opción...";
            this.Load += new System.EventHandler(this.workingPlace_Load);
            this.panel1.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button envios_btn;
        private System.Windows.Forms.Button salir_btn;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Label nombre_apellido_lbl;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label nombre_empaque_lbl;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label nombre_usuario_lbl;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label id_socio_lbl;
        private System.Windows.Forms.Label tipo_socio_lbl;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button recibos_btn;
        private System.Windows.Forms.Label label6;
    }
}