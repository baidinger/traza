namespace CS101_CALLBACK_API_DEMO
{
    partial class sesion
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
            this.ini_sesion_btn = new System.Windows.Forms.Button();
            this.label1 = new System.Windows.Forms.Label();
            this.user_txt = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.pass_txt = new System.Windows.Forms.TextBox();
            this.button1 = new System.Windows.Forms.Button();
            this.button2 = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // ini_sesion_btn
            // 
            this.ini_sesion_btn.BackColor = System.Drawing.Color.DodgerBlue;
            this.ini_sesion_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.ini_sesion_btn.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.ini_sesion_btn.Location = new System.Drawing.Point(40, 161);
            this.ini_sesion_btn.Name = "ini_sesion_btn";
            this.ini_sesion_btn.Size = new System.Drawing.Size(101, 30);
            this.ini_sesion_btn.TabIndex = 9;
            this.ini_sesion_btn.Text = "Iniciar Sesión";
            this.ini_sesion_btn.Click += new System.EventHandler(this.ini_sesion_btn_Click);
            // 
            // label1
            // 
            this.label1.BackColor = System.Drawing.Color.Transparent;
            this.label1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label1.Location = new System.Drawing.Point(17, 37);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(65, 20);
            this.label1.Text = "Usuario:";
            // 
            // user_txt
            // 
            this.user_txt.Location = new System.Drawing.Point(124, 37);
            this.user_txt.Name = "user_txt";
            this.user_txt.Size = new System.Drawing.Size(176, 23);
            this.user_txt.TabIndex = 12;
            // 
            // label2
            // 
            this.label2.BackColor = System.Drawing.Color.Transparent;
            this.label2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label2.Location = new System.Drawing.Point(17, 102);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(89, 20);
            this.label2.Text = "Contraseña:";
            // 
            // pass_txt
            // 
            this.pass_txt.Location = new System.Drawing.Point(124, 98);
            this.pass_txt.Name = "pass_txt";
            this.pass_txt.Size = new System.Drawing.Size(176, 23);
            this.pass_txt.TabIndex = 13;
            // 
            // button1
            // 
            this.button1.BackColor = System.Drawing.Color.Red;
            this.button1.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.button1.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.button1.Location = new System.Drawing.Point(180, 161);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(101, 30);
            this.button1.TabIndex = 16;
            this.button1.Text = "Salir";
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // button2
            // 
            this.button2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.button2.Location = new System.Drawing.Point(124, 201);
            this.button2.Name = "button2";
            this.button2.Size = new System.Drawing.Size(72, 30);
            this.button2.TabIndex = 19;
            this.button2.Text = "Servidor";
            this.button2.Click += new System.EventHandler(this.button2_Click);
            // 
            // sesion
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.BackColor = System.Drawing.Color.Cornsilk;
            this.ClientSize = new System.Drawing.Size(318, 240);
            this.ControlBox = false;
            this.Controls.Add(this.button2);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.pass_txt);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.user_txt);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.ini_sesion_btn);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "sesion";
            this.Text = "Iniciar sesión";
            this.Load += new System.EventHandler(this.sesion_Load);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button ini_sesion_btn;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox user_txt;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox pass_txt;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.Button button2;



    }
}