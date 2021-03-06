﻿using System;
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
    public partial class entradasWorgking : Form
    {
        public DataTable dt;
        public int preIdEnvio, preIdOrden, preIdCarro;
        public int socio, id_socio, id_usuario, datosTabla = 0, rowIndex = -10;
        public String preNombreEmpaque, nombreSocio;

        public entradasWorgking(int socio, int id_socio, int id_usuario, String nombreSocio)
        {
            InitializeComponent();

            dt = new DataTable();
            DataColumn col;

            col = dt.Columns.Add();
            col.ColumnName = "N° de envio";
            col.DataType = typeof(string);

            col = dt.Columns.Add();
            col.ColumnName = "N° de orden";
            col.DataType = typeof(string);

            col = dt.Columns.Add();
            col.ColumnName = "N° de carro";
            col.DataType = typeof(string);

            col = dt.Columns.Add();
            if(socio == 3)
                col.ColumnName = "Empaque";
            if(socio == 4)
                col.ColumnName = "Distribuidor";
            col.DataType = typeof(string);

            this.socio = socio;
            this.id_socio = id_socio;
            this.id_usuario = id_usuario;
            this.nombreSocio = nombreSocio;

            if (socio == 4)
            {
                label3.Text = "N° de cajas enviadas";
                label4.Text = "N° de cajas recibidas";
              //  label5.Visible = false;
               // label6.Visible = false;
                showPallet.Text = "Ver cajas";
            }

            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                /*LLENAR LA TABLA CON LOS ENVIOS PENDIENTES*/
                refreshEnviosPendientes();
            }

        }

        public void refreshEnviosPendientes()
        {
            dt.Rows.Clear();
            String r = "";
            DataRow row;
            r = webServiceDataGrid();

            //MessageBox.Show(r);

            String[] res = r.Split('*');

            if (res[0].CompareTo("Error") == 0)
            {
                // envios[] e = new envios[1];
                //  e[0] = new envios("---", "---", "---");
                // arrList.Add(e[0]);
                datosTabla = 0;

                row = dt.NewRow();
                row[0] = "---";
                row[1] = "---";
                row[2] = "---";
                row[3] = "---";
                dt.Rows.Add(row);
            }else 
                if (res[0].CompareTo("Error1") == 0)
                {
                    MessageBox.Show(res[1],"Error de conexión");
                    this.Close();
                }
                else
                {
                    datosTabla = 1;
                    String[] datosEnvios = res[1].Split(',');
                    int tamanio = datosEnvios.Length - 1;
                    for (int i = 0, j = 0; i < tamanio / 4; i++)
                    {
                        row = dt.NewRow();
                        row[0] = datosEnvios[j];
                        row[1] = datosEnvios[j + 2];
                        row[2] = datosEnvios[j + 1]; 
                        row[3] = datosEnvios[j + 3];
                        dt.Rows.Add(row);

                        j += 4;

                    }
                }
            dataGrid1.DataSource = dt;

            dataGrid1.TableStyles.Clear();
            DataGridTableStyle tableStyle = new DataGridTableStyle();
            tableStyle.MappingName = dt.TableName;
            int y = 0;
            foreach (DataColumn item in dt.Columns)
            {
                DataGridTextBoxColumn tbcName = new DataGridTextBoxColumn();
                if(y == 3)
                    tbcName.Width = 150;
                else
                    tbcName.Width = 80;
                tbcName.MappingName = item.ColumnName;
                tbcName.HeaderText = item.ColumnName;
                
                tableStyle.GridColumnStyles.Add(tbcName);
                
                y++;
            }
            y = 0;
            dataGrid1.TableStyles.Add(tableStyle);

            dataGrid1.Refresh();
        }

        public String webServiceDataGrid()
        {
            string uriEnvios = Program.uri + "mostrarEnvios.php";
            HttpWebRequest request;
            byte[] postBytes;
            Stream requestStream;
            HttpWebResponse response;
            Stream responseStream;

            try
            {
                /*PETICIÓN AL WEBSERVER*/
                request = (HttpWebRequest)WebRequest.Create(uriEnvios);
                request.Method = "POST";
                request.KeepAlive = false;
                request.ProtocolVersion = HttpVersion.Version10;

                postBytes = Encoding.UTF8.GetBytes("datos=" + socio + "," + id_socio);
                request.ContentType = "application/x-www-form-urlencoded";
                request.AllowWriteStreamBuffering = false;
                request.ContentLength = postBytes.Length;
                request.AllowAutoRedirect = false;

                requestStream = request.GetRequestStream();
                requestStream.Write(postBytes, 0, postBytes.Length);
                requestStream.Close();

                /*RESPUESTA DEL WEBSERVER*/
                response = (HttpWebResponse)request.GetResponse();
                responseStream = response.GetResponseStream();

                string jsonString = null;
                using (StreamReader reader2 = new StreamReader(responseStream))
                {
                    jsonString = reader2.ReadToEnd();
                    reader2.Close();
                }
                responseStream.Close();
                response.Close();
                return jsonString;

            }
            catch (Exception e2)
            {
                return "Error1*Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }
        }



        private void button3_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void label2_ParentChanged(object sender, EventArgs e)
        {

        }

        private void dataGrid1_CurrentCellChanged(object sender, EventArgs e)
        {
            dataGrid1.Select(dataGrid1.CurrentRowIndex);

            if (dataGrid1.CurrentRowIndex != rowIndex)
            {

                if (datosTabla == 1)
                {
                    preIdEnvio = int.Parse(dt.Rows[dataGrid1.CurrentRowIndex][0].ToString());
                    preIdOrden = int.Parse(dt.Rows[dataGrid1.CurrentRowIndex][1].ToString());
                    preIdCarro = int.Parse(dt.Rows[dataGrid1.CurrentRowIndex][2].ToString());
                    preNombreEmpaque = dt.Rows[dataGrid1.CurrentRowIndex][3].ToString();

                  //  if (socio == 3)
                  //  {

                        String r = "";
                        using (cargando c = new cargando())
                        {
                            c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                            c.Show();
                            c.Update();
                            r = cuentaPallets();
                        }
                        String[] res = r.Split('*');

                        if (res[0].CompareTo("Error") == 0)
                        {
                            MessageBox.Show(res[1], "Error");
                        }
                        else
                            if (res[0].CompareTo("Error1") == 0)
                            {
                                MessageBox.Show(res[1] + "\n - Intente de nuevo.", "Error de conexión");
                            }
                            else
                            {
                                String[] cant = res[1].Split(',');
                                label5.Text = cant[0];
                                label6.Text = cant[1];
                                empaque_lbl.Text = preNombreEmpaque;
                                compl_send.Enabled = true;
                                cont.Enabled = true;
                                showPallet.Enabled = true;
                                rechazar_btn.Enabled = true;
                            }

                 //   }

                 /*   if (socio == 4)
                    {
                        empaque_lbl.Text = preNombreEmpaque;
                        compl_send.Enabled = true;
                        cont.Enabled = true;
                    }*/
                }
                rowIndex = dataGrid1.CurrentRowIndex;
            }

        }

        public String cuentaPallets()
        {
            string uriEnvios = Program.uri + "cuentaPallets.php";
            HttpWebRequest request;
            byte[] postBytes;
            Stream requestStream;
            HttpWebResponse response;
            Stream responseStream;

            try
            {
                /*PETICIÓN AL WEBSERVER*/
                request = (HttpWebRequest)WebRequest.Create(uriEnvios);
                request.Method = "POST";
                request.KeepAlive = false;
                request.ProtocolVersion = HttpVersion.Version10;

                postBytes = Encoding.UTF8.GetBytes("datos=1," +socio+ "," + preIdEnvio);
                request.ContentType = "application/x-www-form-urlencoded";
                request.AllowWriteStreamBuffering = false;
                request.ContentLength = postBytes.Length;
                request.AllowAutoRedirect = false;

                requestStream = request.GetRequestStream();
                requestStream.Write(postBytes, 0, postBytes.Length);
                requestStream.Close();

                /*RESPUESTA DEL WEBSERVER*/
                response = (HttpWebResponse)request.GetResponse();
                responseStream = response.GetResponseStream();

                string jsonString = null;
                using (StreamReader reader2 = new StreamReader(responseStream))
                {
                    jsonString = reader2.ReadToEnd();
                    reader2.Close();
                }
                responseStream.Close();
                response.Close();
                return jsonString;

            }
            catch (Exception e2)
            {
                return "Error1*Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }

        }

        private void showPallet_Click(object sender, EventArgs e)
        {
            switch(socio){
                case 1:
                    break;
                case 2:
                    break;
                case 3:
                    using (showPallets sp = new showPallets(socio, preIdEnvio, preIdOrden, preIdCarro))
                    {
                        sp.ShowDialog();
                    }
                    break;
                case 4:
                    using (showCajas sc = new showCajas(socio, preIdEnvio, preIdOrden, preIdCarro, ""))
                    {
                        sc.ShowDialog();
                    }
                    break;
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                /*LLENAR LA TABLA CON LOS ENVIOS PENDIENTES*/
                refreshEnviosPendientes();
            }
        }

        private void cont_Click(object sender, EventArgs e)
        {
            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();

                using (readEpcsEntradas inventario = new readEpcsEntradas(socio, id_socio, preIdOrden, preIdCarro, nombreSocio, preNombreEmpaque, id_usuario))
                {
                    inventario.ShowDialog();
                    this.Close();
                }
            }
        }

        private void button1_Click_1(object sender, EventArgs e)
        {
           /* using (showPallets sp = new showPallets(socio, preIdEnvio, 4))
            {
                sp.ShowDialog();
            }*/
        }

        private void compl_send_Click(object sender, EventArgs e)
        {
            using (cargando c = new cargando())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();

                String result = finalizarEnvio("1");
                String[] r = result.Split('*');
                //MessageBox.Show(result);

                if (r[0].CompareTo("Error") == 0)
                {
                    MessageBox.Show(r[1], "Error al finalizar");
                }
                else
                    if (r[0].CompareTo("Error2") == 0)
                    {
                        using (mostrarMessage mM = new mostrarMessage("¿Seguro?", "¿Seguro que deseas finalizar el envio "+preIdEnvio+"?", r[1]))
                       {
                           mM.Location = new Point((320 - mM.Width) / 2, (240 - mM.Height) / 2);
                            
                           if (mM.ShowDialog() == DialogResult.OK)
                           {
                               //MessageBox.Show("Finalizó el envio");
                               String res = finalizarEnvio("2");
                               String[] re = res.Split('*');

                               if (re[0].CompareTo("Error") == 0)
                               {
                                   MessageBox.Show(re[1], "Error al finalizar");
                               }
                               else
                               {
                                   MessageBox.Show(re[1], "Operación exitosa");

                                   refreshEnviosPendientes();
                                   label5.Text = "---";
                                   label6.Text = "---";
                                   cont.Enabled = false;
                                   compl_send.Enabled = false;
                                   showPallet.Enabled = false;
                                   rechazar_btn.Enabled = false;
                               }

                           }
                       }


                    }else
                    {
                        MessageBox.Show(r[1], "Operación exitosa");

                        refreshEnviosPendientes();
                        label5.Text = "---";
                        label6.Text = "---";
                        cont.Enabled = false;
                        compl_send.Enabled = false;
                        showPallet.Enabled = false;
                        rechazar_btn.Enabled = false;
                    }
            }
        }

        public String finalizarEnvio(String tipo)
        {
            string uriEnvios = Program.uri + "finalizarEnvios.php";
            HttpWebRequest request;
            byte[] postBytes;
            Stream requestStream;
            HttpWebResponse response;
            Stream responseStream;

            try
            {
                /*PETICIÓN AL WEBSERVER*/
                request = (HttpWebRequest)WebRequest.Create(uriEnvios);
                request.Method = "POST";
                request.KeepAlive = false;
                request.ProtocolVersion = HttpVersion.Version10;

                postBytes = Encoding.UTF8.GetBytes("datos="+tipo+"," + socio + "," + preIdOrden + "," + preIdEnvio+","+preIdCarro);
                request.ContentType = "application/x-www-form-urlencoded";
                request.AllowWriteStreamBuffering = false;
                request.ContentLength = postBytes.Length;
                request.AllowAutoRedirect = false;

                requestStream = request.GetRequestStream();
                requestStream.Write(postBytes, 0, postBytes.Length);
                requestStream.Close();

                /*RESPUESTA DEL WEBSERVER*/
                response = (HttpWebResponse)request.GetResponse();
                responseStream = response.GetResponseStream();

                string jsonString = null;
                using (StreamReader reader2 = new StreamReader(responseStream))
                {
                    jsonString = reader2.ReadToEnd();
                    reader2.Close();
                }
                responseStream.Close();
                response.Close();
                return jsonString;

            }
            catch (Exception e2)
            {
                return "Error*Error de respuesta de json \n -No encuentra la ruta del webservice :" + e2.Message.ToString();
            }

        }

        private void rechazar_btn_Click(object sender, EventArgs e)
        {
            using (mostrarMessage mM = new mostrarMessage("¿Seguro?", "¿Seguro que deseas rechazar el envio " + preIdEnvio + "?","Si rechaza el envio ya no podrá quitar esta acción"))
            {
                mM.Location = new Point((320 - mM.Width) / 2, (240 - mM.Height) / 2);

                if (mM.ShowDialog() == DialogResult.OK)
                {
                   // MessageBox.Show("Rechazó el envio");
                    String res = finalizarEnvio("3");
                    String[] re = res.Split('*');

                    if (re[0].CompareTo("Error") == 0)
                    {
                        MessageBox.Show(re[1], "Error al finalizar");
                    }
                    else
                    {
                        MessageBox.Show(re[1], "Operación exitosa");

                        refreshEnviosPendientes();
                        label5.Text = "---";
                        label6.Text = "---";
                        cont.Enabled = false;
                        compl_send.Enabled = false;
                        showPallet.Enabled = false;
                        rechazar_btn.Enabled = false;
                    }
                }
            }
        }


    }
}