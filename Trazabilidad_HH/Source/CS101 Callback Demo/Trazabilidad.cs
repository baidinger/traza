using System;
using System.Linq;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using System.Net;
using System.IO;

namespace CS101_CALLBACK_API_DEMO
{
    public partial class Trazabilidad : Form
    {
        public String resp, tipo;
        public String[] Huerta, Productor, Lote, Empaque, Distribuidor, ordDist, enviDist, pv, ordPv, envPv;

        public Trazabilidad(String resp)
        {
            this.resp = resp;
            InitializeComponent();

            obtenerTrazabilidad();

        }

        public void obtenerTrazabilidad()
        {
            String[] datos = resp.Split('*');
            this.tipo = datos[0];

            if (datos[0].CompareTo("1") == 0)
            {
                for (int i = 1; i < datos.Length; i++)
                {
                    String[] trazabilidad = datos[i].Split(',');
                    switch (i)
                    {
                        case 1:
                            Huerta = trazabilidad;
                            break;
                        case 2:
                            Productor = trazabilidad;
                            break;
                        case 3:
                            Lote = trazabilidad;
                            break;
                        case 4:
                            Empaque = trazabilidad;
                            break;
                        case 5:
                            Distribuidor = trazabilidad;
                            break;
                        case 6:
                            ordDist = trazabilidad;
                            break;
                        case 7:
                            enviDist = trazabilidad;
                            break;
                        case 8:
                            pv = trazabilidad;
                            break;
                        case 9:
                            ordPv = trazabilidad;
                            break;
                        case 10:
                            envPv = trazabilidad;
                            break;
                        case 11:
                            break;
                    }
                }

                nom_ape_productor.Text = Productor[1];
                nom_empaque.Text = Empaque[1];
                nom_dist.Text = Distribuidor[1];
                nom_pv.Text = pv[1];
            }
            else if (datos[0].CompareTo("2") == 0)
            {
                for (int i = 1; i < datos.Length; i++)
                {
                    String[] trazabilidad = datos[i].Split(',');

                    switch (i)
                    {
                        case 1:
                            Huerta = trazabilidad;
                            break;
                        case 2:
                            Productor = trazabilidad;
                            break;
                        case 3:
                            Lote = trazabilidad;
                            break;
                        case 4:
                            Empaque = trazabilidad;
                            break;
                        case 5:
                            Distribuidor = trazabilidad;
                            break;
                        case 6:
                            ordDist = trazabilidad;
                            break;
                        case 7:
                            enviDist = trazabilidad;
                            break;
                        case 8:
                            break;
                    }
                }

                nom_ape_productor.Text = Productor[1];
                nom_empaque.Text = Empaque[1];
                nom_dist.Text = Distribuidor[1];

                label5.Visible = false;
                nom_pv.Visible = false;

            }
            else if (datos[0].CompareTo("3") == 0)
            {
                for (int i = 1; i < datos.Length; i++)
                {
                    String[] trazabilidad = datos[i].Split(',');

                    switch (i)
                    {
                        case 1:
                            Huerta = trazabilidad;
                            break;
                        case 2:
                            Productor = trazabilidad;
                            break;
                        case 3:
                            Lote = trazabilidad;
                            break;
                        case 4:
                            Empaque = trazabilidad;
                            break;
                        case 5:
                            ordDist = trazabilidad;
                            break;
                        case 6:
                            enviDist = trazabilidad;
                            break;
                        case 7:
                            break;
                        case 8:
                            break;
                    }
                }

                nom_ape_productor.Text = Productor[1];
                nom_empaque.Text = Empaque[1];

                label4.Visible = false;
                nom_dist.Visible = false;

                label5.Visible = false;
                nom_pv.Visible = false;

            }
            else if (datos[0].CompareTo("4") == 0)
            {
                for (int i = 1; i < datos.Length; i++)
                {
                    String[] trazabilidad = datos[i].Split(',');

                    switch (i)
                    {
                        case 1:
                            Huerta = trazabilidad;
                            break;
                        case 2:
                            Productor = trazabilidad;
                            break;
                        case 3:
                            Lote = trazabilidad;
                            break;
                        case 4:
                            Empaque = trazabilidad;
                            break;
                        case 5:
                            break;
                        case 6:
                            break;
                        case 7:
                            break;
                        case 8:
                            break;
                    }
                }

                nom_ape_productor.Text = Productor[1];
                nom_empaque.Text = Empaque[1];

                label4.Visible = false;
                nom_dist.Visible = false;

                label5.Visible = false;
                nom_pv.Visible = false;

            }

        }

        private void acept_btn_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void nom_ape_productor_Click(object sender, EventArgs e)
        {
            using(datosTraza dT = new datosTraza(Huerta, Productor))
            {
                dT.ShowDialog();
            }
        }

        private void nom_empaque_Click(object sender, EventArgs e)
        {
            if (tipo.CompareTo("4") != 0)
            {
                using (datosTraza dT = new datosTraza(Empaque, Lote, ordDist, enviDist))
                {
                    dT.ShowDialog();
                }
            }
            else
            {
                using (datosTraza dT = new datosTraza(Empaque, Lote))
                {
                    dT.ShowDialog();
                }
            }
        }
    }
}