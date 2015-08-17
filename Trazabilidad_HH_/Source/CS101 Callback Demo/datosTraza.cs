using System;
using System.Linq;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;

namespace CS101_CALLBACK_API_DEMO
{
    public partial class datosTraza : Form
    {
        public String[] Huerta, Productor, Lote, Empaque, Distribuidor, ordDist, enviDist, pv, ordPv, envPv;
        public Label[] labelsP, labelsH, labelsD, labelsE, labelsV;


        public datosTraza(String[] Huerta, String[] Productor)
        {
            InitializeComponent();

            this.Text = "Datos de " + Productor[1];
            this.Huerta = Huerta;
            this.Productor = Productor;

            labelsP = new Label[Productor.Length];

            labelsP[0] = new Label();
            labelsP[0].Location = new System.Drawing.Point(2, 2);
            labelsP[0].Name = "productor_lbl";
            labelsP[0].Size = new System.Drawing.Size(200, 20);
            labelsP[0].Text = "PRORDUCTOR";
            labelsP[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < Productor.Length; i++)
            {
                labelsP[i] = new Label();
                labelsP[i].Location = new System.Drawing.Point(10, 2 + (i * 20));
                labelsP[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsP[i].Text = "Nombre: " + Productor[i];
                        break;
                    case 2:
                        labelsP[i].Text = "RFC: " + Productor[i];
                        break;
                    case 3:
                        labelsP[i].Text = "Dirección: " + Productor[i];
                        break;
                }
                this.Controls.Add(labelsP[i]);
                
            }

            labelsH = new Label[Huerta.Length];
            labelsH[0] = new Label();
            labelsH[0].Location = new System.Drawing.Point(2, 100);
            labelsH[0].Name = "huerta_lbl";
            labelsH[0].Size = new System.Drawing.Size(200, 20);
            labelsH[0].Text = "HUERTA";
            labelsH[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < Huerta.Length; i++)
            {
                labelsH[i] = new Label();
                labelsH[i].Location = new System.Drawing.Point(10, 100 + (i * 20));
                labelsH[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsH[i].Text = "Ubicación: " + Huerta[i];
                        break;
                    case 2:
                        labelsH[i].Text = "N° de hectareas: " + Huerta[i];
                        break;
                    case 3:
                        labelsH[i].Text = "Producto: " + Huerta[i];
                        break;
                }
                this.Controls.Add(labelsH[i]);

            }


            this.Controls.Add(labelsP[0]);
            this.Controls.Add(labelsH[0]);

        }

        public datosTraza(String[] Empaque, String[] Lote, String[] ordDist, String[] envDist)
        {
            InitializeComponent();
            
            this.Text = "Datos de " + Empaque[1];
            this.Empaque = Empaque;
            this.Lote = Lote;
            this.ordDist = ordDist;
            this.enviDist = envDist;

            labelsP = new Label[Empaque.Length];

            labelsP[0] = new Label();
            labelsP[0].Location = new System.Drawing.Point(2, 2);
            labelsP[0].Name = "empaque_lbl";
            labelsP[0].Size = new System.Drawing.Size(200, 20);
            labelsP[0].Text = "EMPAQUE";
            labelsP[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < Empaque.Length; i++)
            {
                labelsP[i] = new Label();
                labelsP[i].Location = new System.Drawing.Point(10, 2 + (i * 20));
                labelsP[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsP[i].Text = "Nombre: " + Empaque[i];
                        break;
                    case 2:
                        labelsP[i].Text = "RFC: " + Empaque[i];
                        break;
                }
                this.Controls.Add(labelsP[i]);

            }

            labelsH = new Label[Lote.Length];
            labelsH[0] = new Label();
            labelsH[0].Location = new System.Drawing.Point(2, 60);
            labelsH[0].Name = "Lote_lbl";
            labelsH[0].Size = new System.Drawing.Size(200, 20);
            labelsH[0].Text = "LOTE";
            labelsH[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < Lote.Length; i++)
            {
                labelsH[i] = new Label();
                labelsH[i].Location = new System.Drawing.Point(10, 60 + (i * 20));
                labelsH[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsH[i].Text = "N° de lote: " + Lote[i];
                        break;
                    case 2:
                        labelsH[i].Text = "Remitente: " + Lote[i];
                        break;
                    case 3:
                        labelsH[i].Text = "Fecha recibido: " + Lote[i];
                        break;
                }
                this.Controls.Add(labelsH[i]);

            }

            labelsD = new Label[ordDist.Length];
            labelsD[0] = new Label();
            labelsD[0].Location = new System.Drawing.Point(2, 140);
            labelsD[0].Name = "orden_dist_lbl";
            labelsD[0].Size = new System.Drawing.Size(200, 20);
            labelsD[0].Text = "Orden del Distribuidor";
            labelsD[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < ordDist.Length; i++)
            {
                labelsD[i] = new Label();
                labelsD[i].Location = new System.Drawing.Point(10, 140 + (i * 20));
                labelsD[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsD[i].Text = "N° de orden: " + ordDist[i];
                        break;
                    case 2:
                        labelsD[i].Text = "Fecha: " + ordDist[i];
                        break;
                    case 3:
                        labelsD[i].Text = "Estado: " + ordDist[i];
                        break;
                }
                this.Controls.Add(labelsD[i]);

            }

            labelsE = new Label[envDist.Length];
            labelsE[0] = new Label();
            labelsE[0].Location = new System.Drawing.Point(2, 220);
            labelsE[0].Name = "env_dist_lbl";
            labelsE[0].Size = new System.Drawing.Size(200, 20);
            labelsE[0].Text = "Envio al Distribuidor";
            labelsE[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < envDist.Length; i++)
            {
                labelsE[i] = new Label();
                labelsE[i].Location = new System.Drawing.Point(10, 220 + (i * 20));
                labelsE[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsE[i].Text = "N° de envio: " + envDist[i];
                        break;
                    case 2:
                        labelsE[i].Text = "N° de camión: " + envDist[i];
                        break;
                    case 3:
                        labelsE[i].Text = "Fecha: " + envDist[i];
                        break;
                    case 4:
                        labelsE[i].Text = "Estado: " + envDist[i];
                        break;
                    case 5:
                        labelsE[i].Text = "Fecha de entrega: " + envDist[i];
                        break;
                }
                this.Controls.Add(labelsE[i]);

            }

            this.Controls.Add(labelsE[0]);
            this.Controls.Add(labelsD[0]);
            this.Controls.Add(labelsP[0]);
            this.Controls.Add(labelsH[0]);

        }

        public datosTraza(int y, String[] Empaque, String[] Lote)
        {
            InitializeComponent();

            this.Text = "Datos de " + Empaque[1];
            this.Empaque = Empaque;
            this.Lote = Lote;

            labelsP = new Label[Empaque.Length];

            labelsP[0] = new Label();
            labelsP[0].Location = new System.Drawing.Point(2, 2);
            labelsP[0].Name = "empaque_lbl";
            labelsP[0].Size = new System.Drawing.Size(200, 20);
            labelsP[0].Text = "EMPAQUE";
            labelsP[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < Empaque.Length; i++)
            {
                labelsP[i] = new Label();
                labelsP[i].Location = new System.Drawing.Point(10, 2 + (i * 20));
                labelsP[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsP[i].Text = "Nombre: " + Empaque[i];
                        break;
                    case 2:
                        labelsP[i].Text = "RFC: " + Empaque[i];
                        break;
                }
                this.Controls.Add(labelsP[i]);

            }

            labelsH = new Label[Lote.Length];
            labelsH[0] = new Label();
            labelsH[0].Location = new System.Drawing.Point(2, 60);
            labelsH[0].Name = "Lote_lbl";
            labelsH[0].Size = new System.Drawing.Size(200, 20);
            labelsH[0].Text = "LOTE";
            labelsH[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < Lote.Length; i++)
            {
                labelsH[i] = new Label();
                labelsH[i].Location = new System.Drawing.Point(10, 60 + (i * 20));
                labelsH[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsH[i].Text = "N° de lote: " + Lote[i];
                        break;
                    case 2:
                        labelsH[i].Text = "Remitente: " + Lote[i];
                        break;
                    case 3:
                        labelsH[i].Text = "Fecha recibido: " + Lote[i];
                        break;
                }
                this.Controls.Add(labelsH[i]);

            }

            this.Controls.Add(labelsP[0]);
            this.Controls.Add(labelsH[0]);

        }

        public datosTraza(String[] Distribuidor, String[] ordDist, String[] envDist)
        {
            InitializeComponent();

            this.Text = "Datos de " + Distribuidor[1];
            this.Distribuidor = Distribuidor;
            this.ordDist = ordDist;
            this.enviDist = envDist;

            labelsP = new Label[Distribuidor.Length];

            labelsP[0] = new Label();
            labelsP[0].Location = new System.Drawing.Point(2, 2);
            labelsP[0].Name = "dist_lbl";
            labelsP[0].Size = new System.Drawing.Size(200, 20);
            labelsP[0].Text = "DISTRIBUIDOR";
            labelsP[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < Distribuidor.Length; i++)
            {
                labelsP[i] = new Label();
                labelsP[i].Location = new System.Drawing.Point(10, 2 + (i * 20));
                labelsP[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsP[i].Text = "Nombre: " + Distribuidor[i];
                        break;
                    case 2:
                        labelsP[i].Text = "RFC: " + Distribuidor[i];
                        break;
                }
                this.Controls.Add(labelsP[i]);

            }

            labelsD = new Label[ordDist.Length];
            labelsD[0] = new Label();
            labelsD[0].Location = new System.Drawing.Point(2, 60);
            labelsD[0].Name = "orden_dist_lbl";
            labelsD[0].Size = new System.Drawing.Size(200, 20);
            labelsD[0].Text = "Orden del Distribuidor";
            labelsD[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < ordDist.Length; i++)
            {
                labelsD[i] = new Label();
                labelsD[i].Location = new System.Drawing.Point(10, 60 + (i * 20));
                labelsD[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsD[i].Text = "N° de orden: " + ordDist[i];
                        break;
                    case 2:
                        labelsD[i].Text = "Fecha: " + ordDist[i];
                        break;
                    case 3:
                        labelsD[i].Text = "Estado: " + ordDist[i];
                        break;
                }
                this.Controls.Add(labelsD[i]);

            }

            labelsE = new Label[envDist.Length];
            labelsE[0] = new Label();
            labelsE[0].Location = new System.Drawing.Point(2, 140);
            labelsE[0].Name = "env_dist_lbl";
            labelsE[0].Size = new System.Drawing.Size(200, 20);
            labelsE[0].Text = "Envio al Distribuidor";
            labelsE[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < envDist.Length; i++)
            {
                labelsE[i] = new Label();
                labelsE[i].Location = new System.Drawing.Point(10, 140 + (i * 20));
                labelsE[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsE[i].Text = "N° de envio: " + envDist[i];
                        break;
                    case 2:
                        labelsE[i].Text = "N° de camión: " + envDist[i];
                        break;
                    case 3:
                        labelsE[i].Text = "Fecha: " + envDist[i];
                        break;
                    case 4:
                        labelsE[i].Text = "Estado: " + envDist[i];
                        break;
                    case 5:
                        labelsE[i].Text = "Fecha de entrega: " + envDist[i];
                        break;
                }
                this.Controls.Add(labelsE[i]);

            }

            this.Controls.Add(labelsE[0]);
            this.Controls.Add(labelsD[0]);
            this.Controls.Add(labelsP[0]);

        }


        public datosTraza(int y, String[] Distribuidor, String[] ordDist, String[] envDist, String[] ordPv, String[] envPv)
        {
            InitializeComponent();

            this.Text = "Datos de " + Distribuidor[1];
            this.Distribuidor = Distribuidor;
            this.ordDist = ordDist;
            this.enviDist = envDist;

            labelsP = new Label[Distribuidor.Length];

            labelsP[0] = new Label();
            labelsP[0].Location = new System.Drawing.Point(2, 2);
            labelsP[0].Name = "dist_lbl";
            labelsP[0].Size = new System.Drawing.Size(200, 20);
            labelsP[0].Text = "DISTRIBUIDOR";
            labelsP[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < Distribuidor.Length; i++)
            {
                labelsP[i] = new Label();
                labelsP[i].Location = new System.Drawing.Point(10, 2 + (i * 20));
                labelsP[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsP[i].Text = "Nombre: " + Distribuidor[i];
                        break;
                    case 2:
                        labelsP[i].Text = "RFC: " + Distribuidor[i];
                        break;
                }
                this.Controls.Add(labelsP[i]);

            }

            labelsH = new Label[ordDist.Length];
            labelsH[0] = new Label();
            labelsH[0].Location = new System.Drawing.Point(2, 60);
            labelsH[0].Name = "orden_dist_lbl";
            labelsH[0].Size = new System.Drawing.Size(200, 20);
            labelsH[0].Text = "Orden del Distribuidor";
            labelsH[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < ordDist.Length; i++)
            {
                labelsH[i] = new Label();
                labelsH[i].Location = new System.Drawing.Point(10, 60 + (i * 20));
                labelsH[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsH[i].Text = "N° de orden: " + ordDist[i];
                        break;
                    case 2:
                        labelsH[i].Text = "Fecha: " + ordDist[i];
                        break;
                    case 3:
                        labelsH[i].Text = "Estado: " + ordDist[i];
                        break;
                }
                this.Controls.Add(labelsH[i]);

            }

            labelsD = new Label[envDist.Length];
            labelsD[0] = new Label();
            labelsD[0].Location = new System.Drawing.Point(2, 140);
            labelsD[0].Name = "env_dist_lbl";
            labelsD[0].Size = new System.Drawing.Size(200, 20);
            labelsD[0].Text = "Envio al Distribuidor";
            labelsD[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < envDist.Length; i++)
            {
                labelsD[i] = new Label();
                labelsD[i].Location = new System.Drawing.Point(10, 140 + (i * 20));
                labelsD[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsD[i].Text = "N° de envio: " + envDist[i];
                        break;
                    case 2:
                        labelsD[i].Text = "N° de camión: " + envDist[i];
                        break;
                    case 3:
                        labelsD[i].Text = "Fecha: " + envDist[i];
                        break;
                    case 4:
                        labelsD[i].Text = "Estado: " + envDist[i];
                        break;
                    case 5:
                        labelsD[i].Text = "Fecha de entrega: " + envDist[i];
                        break;
                }
                this.Controls.Add(labelsD[i]);

            }

            labelsE = new Label[ordPv.Length];
            labelsE[0] = new Label();
            labelsE[0].Location = new System.Drawing.Point(2, 260);
            labelsE[0].Name = "ord_pv_lbl";
            labelsE[0].Size = new System.Drawing.Size(200, 20);
            labelsE[0].Text = "Orden del punto de venta";
            labelsE[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < ordPv.Length; i++)
            {
                labelsE[i] = new Label();
                labelsE[i].Location = new System.Drawing.Point(10, 260 + (i * 20));
                labelsE[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsE[i].Text = "N° de orden: " + ordPv[i];
                        break;
                    case 2:
                        labelsE[i].Text = "Fecha: " + ordPv[i];
                        break;
                    case 3:
                        labelsE[i].Text = "Estado: " + ordPv[i];
                        break;
                }
                this.Controls.Add(labelsE[i]);

            }

            labelsV = new Label[envPv.Length];
            labelsV[0] = new Label();
            labelsV[0].Location = new System.Drawing.Point(2, 340);
            labelsV[0].Name = "env_pv_lbl";
            labelsV[0].Size = new System.Drawing.Size(200, 20);
            labelsV[0].Text = "Envio al Punto de venta";
            labelsV[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < envPv.Length; i++)
            {
                labelsV[i] = new Label();
                labelsV[i].Location = new System.Drawing.Point(10, 340 + (i * 20));
                labelsV[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsV[i].Text = "N° de envio: " + envPv[i];
                        break;
                    case 2:
                        labelsV[i].Text = "N° de camión: " + envPv[i];
                        break;
                    case 3:
                        labelsV[i].Text = "Fecha: " + envPv[i];
                        break;
                    case 4:
                        labelsV[i].Text = "Estado: " + envPv[i];
                        break;
                    case 5:
                        labelsV[i].Text = "Fecha de entrega: " + envPv[i];
                        break;
                }
                this.Controls.Add(labelsV[i]);

            }

            this.Controls.Add(labelsV[0]);
            this.Controls.Add(labelsE[0]);
            this.Controls.Add(labelsD[0]);
            this.Controls.Add(labelsH[0]);
            this.Controls.Add(labelsP[0]);

        }

        public datosTraza(int y, String[] pv, String[] ordPv, String[] envPv)
        {
            InitializeComponent();

            this.Text = "Datos de " + pv[1];
            this.pv = pv;
            this.ordPv = ordDist;
            this.enviDist = envPv;

            labelsP = new Label[pv.Length];

            labelsP[0] = new Label();
            labelsP[0].Location = new System.Drawing.Point(2, 2);
            labelsP[0].Name = "dist_lbl";
            labelsP[0].Size = new System.Drawing.Size(200, 20);
            labelsP[0].Text = "PUNTO DE VENTA";
            labelsP[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < pv.Length; i++)
            {
                labelsP[i] = new Label();
                labelsP[i].Location = new System.Drawing.Point(10, 2 + (i * 20));
                labelsP[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsP[i].Text = "Nombre: " + pv[i];
                        break;
                    case 2:
                        labelsP[i].Text = "RFC: " + pv[i];
                        break;
                }
                this.Controls.Add(labelsP[i]);

            }

            labelsE = new Label[ordPv.Length];
            labelsE[0] = new Label();
            labelsE[0].Location = new System.Drawing.Point(2, 60);
            labelsE[0].Name = "ord_pv_lbl";
            labelsE[0].Size = new System.Drawing.Size(200, 20);
            labelsE[0].Text = "Orden del punto de venta";
            labelsE[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < ordPv.Length; i++)
            {
                labelsE[i] = new Label();
                labelsE[i].Location = new System.Drawing.Point(10, 60 + (i * 20));
                labelsE[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsE[i].Text = "N° de orden: " + ordPv[i];
                        break;
                    case 2:
                        labelsE[i].Text = "Fecha: " + ordPv[i];
                        break;
                    case 3:
                        labelsE[i].Text = "Estado: " + ordPv[i];
                        break;
                }
                this.Controls.Add(labelsE[i]);

            }

            labelsV = new Label[envPv.Length];
            labelsV[0] = new Label();
            labelsV[0].Location = new System.Drawing.Point(2, 140);
            labelsV[0].Name = "env_pv_lbl";
            labelsV[0].Size = new System.Drawing.Size(200, 20);
            labelsV[0].Text = "Envio al Punto de venta";
            labelsV[0].Font = new System.Drawing.Font("Tahoma", 11F, System.Drawing.FontStyle.Bold);

            for (int i = 1; i < envPv.Length; i++)
            {
                labelsV[i] = new Label();
                labelsV[i].Location = new System.Drawing.Point(10, 140 + (i * 20));
                labelsV[i].Size = new System.Drawing.Size(300, 20);
                switch (i)
                {
                    case 1:
                        labelsV[i].Text = "N° de envio: " + envPv[i];
                        break;
                    case 2:
                        labelsV[i].Text = "N° de camión: " + envPv[i];
                        break;
                    case 3:
                        labelsV[i].Text = "Fecha: " + envPv[i];
                        break;
                    case 4:
                        labelsV[i].Text = "Estado: " + envPv[i];
                        break;
                    case 5:
                        labelsV[i].Text = "Fecha de entrega: " + envPv[i];
                        break;
                }
                this.Controls.Add(labelsV[i]);

            }

            this.Controls.Add(labelsV[0]);
            this.Controls.Add(labelsE[0]);
            this.Controls.Add(labelsP[0]);

        }

    }
}