namespace CS101_CALLBACK_API_DEMO
{
    partial class Trazabilidad
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
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.nom_ape_productor = new System.Windows.Forms.LinkLabel();
            this.nom_empaque = new System.Windows.Forms.LinkLabel();
            this.label4 = new System.Windows.Forms.Label();
            this.nom_dist = new System.Windows.Forms.LinkLabel();
            this.label5 = new System.Windows.Forms.Label();
            this.nom_pv = new System.Windows.Forms.LinkLabel();
            this.acept_btn = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.Font = new System.Drawing.Font("Tahoma", 14F, System.Drawing.FontStyle.Bold);
            this.label1.Location = new System.Drawing.Point(0, 0);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(310, 25);
            this.label1.Text = "Trazabilidad";
            // 
            // label2
            // 
            this.label2.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label2.Location = new System.Drawing.Point(3, 35);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(78, 20);
            this.label2.Text = "Productor";
            // 
            // label3
            // 
            this.label3.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label3.Location = new System.Drawing.Point(3, 71);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(100, 20);
            this.label3.Text = "Empaque";
            // 
            // nom_ape_productor
            // 
            this.nom_ape_productor.Font = new System.Drawing.Font("Tahoma", 9F, System.Drawing.FontStyle.Underline);
            this.nom_ape_productor.Location = new System.Drawing.Point(19, 50);
            this.nom_ape_productor.Name = "nom_ape_productor";
            this.nom_ape_productor.Size = new System.Drawing.Size(298, 21);
            this.nom_ape_productor.TabIndex = 3;
            this.nom_ape_productor.Text = "nom_ape_productor";
            this.nom_ape_productor.Click += new System.EventHandler(this.nom_ape_productor_Click);
            // 
            // nom_empaque
            // 
            this.nom_empaque.Font = new System.Drawing.Font("Tahoma", 9F, System.Drawing.FontStyle.Underline);
            this.nom_empaque.Location = new System.Drawing.Point(19, 87);
            this.nom_empaque.Name = "nom_empaque";
            this.nom_empaque.Size = new System.Drawing.Size(291, 20);
            this.nom_empaque.TabIndex = 4;
            this.nom_empaque.Text = "nom_empaque";
            this.nom_empaque.Click += new System.EventHandler(this.nom_empaque_Click);
            // 
            // label4
            // 
            this.label4.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label4.Location = new System.Drawing.Point(4, 111);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(100, 20);
            this.label4.Text = "Distribuidor";
            // 
            // nom_dist
            // 
            this.nom_dist.Font = new System.Drawing.Font("Tahoma", 9F, System.Drawing.FontStyle.Underline);
            this.nom_dist.Location = new System.Drawing.Point(19, 126);
            this.nom_dist.Name = "nom_dist";
            this.nom_dist.Size = new System.Drawing.Size(291, 20);
            this.nom_dist.TabIndex = 6;
            this.nom_dist.Text = "nom_dist";
            // 
            // label5
            // 
            this.label5.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.label5.Location = new System.Drawing.Point(4, 150);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(144, 20);
            this.label5.Text = "Punto de Venta";
            // 
            // nom_pv
            // 
            this.nom_pv.Font = new System.Drawing.Font("Tahoma", 9F, System.Drawing.FontStyle.Underline);
            this.nom_pv.Location = new System.Drawing.Point(19, 169);
            this.nom_pv.Name = "nom_pv";
            this.nom_pv.Size = new System.Drawing.Size(291, 20);
            this.nom_pv.TabIndex = 8;
            this.nom_pv.Text = "nom_pv";
            // 
            // acept_btn
            // 
            this.acept_btn.Font = new System.Drawing.Font("Tahoma", 10F, System.Drawing.FontStyle.Bold);
            this.acept_btn.Location = new System.Drawing.Point(117, 199);
            this.acept_btn.Name = "acept_btn";
            this.acept_btn.Size = new System.Drawing.Size(77, 32);
            this.acept_btn.TabIndex = 9;
            this.acept_btn.Text = "Aceptar";
            this.acept_btn.Click += new System.EventHandler(this.acept_btn_Click);
            // 
            // Trazabilidad
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.AutoScroll = true;
            this.ClientSize = new System.Drawing.Size(320, 240);
            this.ControlBox = false;
            this.Controls.Add(this.acept_btn);
            this.Controls.Add(this.nom_pv);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.nom_dist);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.nom_empaque);
            this.Controls.Add(this.nom_ape_productor);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "Trazabilidad";
            this.Text = "Trazabilidad";
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.LinkLabel nom_ape_productor;
        private System.Windows.Forms.LinkLabel nom_empaque;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.LinkLabel nom_dist;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.LinkLabel nom_pv;
        private System.Windows.Forms.Button acept_btn;
    }
}