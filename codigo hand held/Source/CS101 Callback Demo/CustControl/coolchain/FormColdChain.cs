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
    using CSLibrary;
    using CSLibrary.Constants;
    using CSLibrary.Structures;
    using CSLibrary.Device;
    using CSLibrary.Text;

    using CSLibrary.HotKeys;

    public partial class FormColdChain : Form
    {
        public FormColdChain()
        {
            InitializeComponent();
        }

        private void AttachCallback(bool en)
        {
            if (en)
            {
                HotKeys.OnKeyEvent += new HotKeys.HotKeyEventArgs(HotKey_OnKeyEvent);

                Program.ReaderCE.OnStateChanged += new EventHandler<CSLibrary.Events.OnStateChangedEventArgs>(Reader_StateChangedEvent);
                Program.ReaderCE.OnAsyncCallback += new EventHandler<CSLibrary.Events.OnAsyncCallbackEventArgs>(Reader_TagInventoryEvent);
            }
            else
            {
                HotKeys.OnKeyEvent -= new HotKeys.HotKeyEventArgs(HotKey_OnKeyEvent);

                Program.ReaderCE.OnAsyncCallback -= new EventHandler<CSLibrary.Events.OnAsyncCallbackEventArgs>(Reader_TagInventoryEvent);
                Program.ReaderCE.OnStateChanged -= new EventHandler<CSLibrary.Events.OnStateChangedEventArgs>(Reader_StateChangedEvent);
            }
        }

        void EM4324Info(TagCallbackInfo info)
        {
            string EPC;
            string LowBatAlarm;
            bool find = false;

            EPC = info.epc.ToString().Substring(0, (int)(info.pc.EPCLength * 4));

            if ((info.epc.ToUshorts()[info.pc.EPCLength + 2] & 0x02) != 00)
                LowBatAlarm = "Fail";
            else
                LowBatAlarm = "OK";

            for (int cnt = 0; cnt < listView1.Items.Count; cnt++)
            {
                if (listView1.Items[cnt].SubItems[0].Text == EPC)
                {
                    find = true;
                    listView1.Items[cnt].SubItems[3].Text = LowBatAlarm;
                    break;
                }
            }

            if (find == false)
            {
                ListViewItem ins = new ListViewItem(EPC);
                ins.SubItems.Add("");
                ins.SubItems.Add("");
                ins.SubItems.Add(LowBatAlarm);

                listView1.Items.Add(ins);
            }
        }

        void EM4325Info(TagCallbackInfo info)
        {
            string EPC;
            string LowBatAlarm;
            bool find = false;
            UInt16 SensorDataMsw, SensorDataLsw;
            UInt16 UtcMsw, UtcLsw;
            UInt16 StartTimeMsw, StartTimeLsw;
            string Temperature;
            string TempAlarm;

            EPC = info.epc.ToString().Substring(0, (int)((info.pc.EPCLength - 1) * 4));

            SensorDataMsw = info.epc.ToUshorts()[info.pc.EPCLength + 1];
            SensorDataLsw = info.epc.ToUshorts()[info.pc.EPCLength + 2];
            UtcMsw = info.epc.ToUshorts()[info.pc.EPCLength + 3];
            UtcLsw = info.epc.ToUshorts()[info.pc.EPCLength + 4];
            StartTimeMsw = info.epc.ToUshorts()[info.pc.EPCLength + 6];
            StartTimeLsw = info.epc.ToUshorts()[info.pc.EPCLength + 7];

            if ((SensorDataMsw & 0x0400) != 0)
            {
                double Temp;
                Temp = (SensorDataMsw & 0x00ff);
                if ((SensorDataMsw & 0x0100) != 00)
                    Temp -= 256;
                Temp *= 0.25;
                Temperature = Temp.ToString();
            }
            else
                Temperature = "NA";

            if ((SensorDataMsw & 0x3000) != 00)
                TempAlarm = "Fail";
            else
                TempAlarm = "OK";
            
            if ((SensorDataMsw & 0x8000) != 00)
                LowBatAlarm = "Fail";
            else
                LowBatAlarm = "OK";

            for (int cnt = 0; cnt < listView1.Items.Count; cnt++)
            {
                if (listView1.Items[cnt].SubItems[0].Text == EPC)
                {
                    find = true;
                    listView1.Items[cnt].SubItems[1].Text = Temperature;
                    listView1.Items[cnt].SubItems[2].Text = TempAlarm;
                    listView1.Items[cnt].SubItems[3].Text = LowBatAlarm;
                    listView1.Items[cnt].SubItems[4].Text = SensorDataMsw.ToString();
                    listView1.Items[cnt].SubItems[5].Text = SensorDataLsw.ToString();
                    listView1.Items[cnt].SubItems[6].Text = UtcMsw.ToString();
                    listView1.Items[cnt].SubItems[7].Text = UtcLsw.ToString();
                    listView1.Items[cnt].SubItems[8].Text = StartTimeMsw.ToString();
                    listView1.Items[cnt].SubItems[9].Text = StartTimeLsw.ToString();
                    break;
                }
            }

            if (find == false)
            {
                ListViewItem ins = new ListViewItem(EPC);
                ins.SubItems.Add(Temperature);
                ins.SubItems.Add(TempAlarm);
                ins.SubItems.Add(LowBatAlarm);
                ins.SubItems.Add(SensorDataMsw.ToString ());
                ins.SubItems.Add(SensorDataLsw.ToString());
                ins.SubItems.Add(UtcMsw.ToString());
                ins.SubItems.Add(UtcLsw.ToString());
                ins.SubItems.Add(StartTimeMsw.ToString());
                ins.SubItems.Add(StartTimeLsw.ToString());
                listView1.Items.Add(ins);
            }
        }

        void Reader_TagInventoryEvent(object sender, CSLibrary.Events.OnAsyncCallbackEventArgs e)
        {
            Invoke((System.Threading.ThreadStart)delegate()
            {
                UInt32 tid;

                try
                {
                    if (e.type == CallbackType.TAG_RANGING)
                    {
                        if (radioButton1.Checked) // EM4324
                        {
                            if (e.info.epc.GetLength() < e.info.pc.EPCLength + 3)
                                return;

                            tid = (UInt32)((e.info.epc.ToUshorts()[e.info.pc.EPCLength] << 16) | e.info.epc.ToUshorts()[e.info.pc.EPCLength + 1]);
                            if (tid != 0xe200b001U && tid != 0xe200b002U)
                                return;

                            EM4324Info (e.info);
                        }
                        else if (radioButton2.Checked)// EM4325
                        {
                            if (e.info.epc.GetLength() < e.info.pc.EPCLength + 6)
                                return;

                            tid = (UInt32)((e.info.epc.ToUshorts()[e.info.pc.EPCLength - 1] << 16) | e.info.epc.ToUshorts()[e.info.pc.EPCLength]) & 0xffffffc0U;
                            if (tid != 0xe280b040U)
                                return;

                            EM4325Info(e.info);
                        }
                        else
                            return;
                    }
                }
                catch (Exception ex)
                {
                }
            });
        }


        void StartInventory()
        {
            Program.ReaderCE.SetOperationMode(RadioOperationMode.CONTINUOUS);
            Program.ReaderCE.SetTagGroup(Program.appSetting.tagGroup);
            Program.ReaderCE.SetSingulationAlgorithmParms(Program.appSetting.Singulation, Program.appSetting.SingulationAlg);
            Program.ReaderCE.Options.TagRanging.flags = SelectFlags.ZERO;

            Program.ReaderCE.Options.TagRanging.multibanks = 2;
            Program.ReaderCE.Options.TagRanging.bank1 = MemoryBank.TID;
            Program.ReaderCE.Options.TagRanging.offset1 = 0;
            Program.ReaderCE.Options.TagRanging.count1 = 2;
            Program.ReaderCE.Options.TagRanging.bank2 = MemoryBank.BANK3;
            if (radioButton1.Checked)
            {
                Program.ReaderCE.Options.TagRanging.offset2 = 45;
                Program.ReaderCE.Options.TagRanging.count2 = 1;
            }
            else if (radioButton2.Checked)
            {
                Program.ReaderCE.Options.TagRanging.offset2 = 256;
                Program.ReaderCE.Options.TagRanging.count2 = 7;
            }
            else
            {
                Program.ReaderCE.Options.TagRanging.multibanks = 1;
            }

            Program.ReaderCE.StartOperation(CSLibrary.Constants.Operation.TAG_RANGING_READ_BANKS, false);
        }

        void Reader_StateChangedEvent(object sender, CSLibrary.Events.OnStateChangedEventArgs e)
        {
            Invoke((System.Threading.ThreadStart)delegate()
            {
                switch (e.state)
                {
                    case RFState.IDLE:
                        break;
                    case RFState.BUSY:
                        Device.MelodyPlay(RingTone.T2, BuzzerVolume.HIGH);
                        break;
                    case RFState.ABORT:
                        break;
                    case RFState.RESET:
                        break;
                }
            });
        }

        void HotKey_OnKeyEvent(Key KeyCode, bool KeyDown)
        {
            switch (KeyCode)
            {
                case Key.F4:
                    //PowerUp
                    if (KeyDown)
                        Program.Power.PowerUp();
                    break;

                case Key.F5:
                    //PowerDown
                    if (KeyDown)
                        Program.Power.PowerDown();
                    break;

                case Key.F11:
                    if (KeyDown)
                        btn_start_Click(this, null);
                    break;
            }
        }

        private void FormEM432xBatteryCheck_Load(object sender, EventArgs e)
        {
            AttachCallback(true);
        }

        private void FormEM432xBatteryCheck_Closing(object sender, CancelEventArgs e)
        {
            AttachCallback(false);
        }

        private void btn_start_Click(object sender, EventArgs e)
        {
            if (Program.ReaderCE.State == RFState.IDLE)
            {
                btn_start.Text = "Stop";

                listView1.Clear();

                this.listView1.Columns.Add(this.columnHeader1);
                this.listView1.Columns.Add(this.columnHeader2);
                this.listView1.Columns.Add(this.columnHeader3);
                this.listView1.Columns.Add(this.columnHeader4);

                StartInventory();

                radioButton1.Enabled = false;
                radioButton2.Enabled = false;
            }
            else
            {
                btn_start.Text = "Start";
                Program.ReaderCE.StopOperation(true);

                radioButton1.Enabled = true;
                radioButton2.Enabled = true;
            }
        }

        private void btn_exit_Click(object sender, EventArgs e)
        {
            if (Program.ReaderCE.State != RFState.IDLE)
                Program.ReaderCE.StopOperation(true);

            this.Close();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (Program.ReaderCE.State == RFState.IDLE)
            {
                Int16 value;
                UInt16 v; 
                string Cmd;

                Device.MelodyPlay(RingTone.T2, BuzzerVolume.HIGH);

                Application.DoEvents();

                Double UnderTempThreshold = Double.Parse(textBox3.Text) / .25;
                Double OverTempThreshold = Double.Parse(textBox4.Text) / .25;

                value = (Int16)(UnderTempThreshold);
                v = (UInt16)((UInt16)(value & 0x1ff) | 0x4800);
                Cmd = v.ToString("X4");

                value = (Int16)(OverTempThreshold) ;
                v = (UInt16)((UInt16)(value & 0x1ff) | 0x4400);
                Cmd += v.ToString("X4");

                Program.ReaderCE.Options.TagSelected.flags = SelectMaskFlags.ENABLE_TOGGLE;
                //Comment:If enable PC lock, please make sure you are not using Higgs3 Tag. Otherwise, write will fail
                Program.ReaderCE.Options.TagSelected.epcMask = new S_MASK(textBox1.Text);
                Program.ReaderCE.Options.TagSelected.epcMaskLength = (uint)Program.ReaderCE.Options.TagSelected.epcMask.Length * 8;

                if (Program.ReaderCE.StartOperation(Operation.TAG_SELECTED, true) != Result.OK)
                {
                    MessageBox.Show("Selected tag failed");
                    return;
                }

                Program.ReaderCE.Options.TagWriteUser.retryCount = 30;
                Program.ReaderCE.Options.TagWriteUser.accessPassword = UInt32.Parse (textBox2.Text);

                Program.ReaderCE.Options.TagWriteUser.offset = 236;
                Program.ReaderCE.Options.TagWriteUser.count = 8;
                //Program.ReaderCE.Options.TagWriteUser.pData = Hex.ToUshorts("480044C804064CC00188E00080070000");
                Program.ReaderCE.Options.TagWriteUser.pData = Hex.ToUshorts(Cmd + "04064CC00188E00080070000");
                if (Program.ReaderCE.StartOperation(Operation.TAG_WRITE_USER, true) != Result.OK)
                {
                    MessageBox.Show ("Cannot Set Parameter");
                    return;
                }

                Program.ReaderCE.Options.TagWriteUser.offset = 269;
                Program.ReaderCE.Options.TagWriteUser.count = 1;
                Program.ReaderCE.Options.TagWriteUser.pData = Hex.ToUshorts("0001");
                if (Program.ReaderCE.StartOperation(Operation.TAG_WRITE_USER, true) != Result.OK)
                {
                    MessageBox.Show("Cannot Set Parameter");
                    return;
                }

                // Start Monitoring

                UInt16[] Now = new UInt16[5];
                Now[0] = 0x8000;
                Now[1] = 0x0000;
                Now[2] = 0x0000;
                Now[3] = (UInt16)(ConvertToUnixTimestamp(DateTime.Now) >> 16);
                Now[4] = (UInt16)(ConvertToUnixTimestamp (DateTime.Now) & 0xffff);


//                Now[2] = (UInt16)(DateTime.Now.Ticks >> 16);
//                Now[3] = (UInt16)(DateTime.Now.Ticks & 0xffff);

                Program.ReaderCE.Options.TagWriteUser.offset = 258;
                Program.ReaderCE.Options.TagWriteUser.count = 5;
                Program.ReaderCE.Options.TagWriteUser.pData = Now;
                if (Program.ReaderCE.StartOperation(Operation.TAG_WRITE_USER, true) != Result.OK)
                {
                    MessageBox.Show("Cannot Enable Monitor");
                    return;
                }

                MessageBox.Show("Enable Monitor Success");
            }
        }

        private void radioButton2_CheckedChanged(object sender, EventArgs e)
        {
            if (radioButton2.Checked == true)
            {
                this.listView1.Columns[0].Width = 180;  // EPC
                this.listView1.Columns[1].Width = 48;   // Temp.
                this.listView1.Columns[2].Width = 30;   // Temp. Alert
                this.listView1.Columns[3].Width = 30;   // Battery Alert
                this.listView1.Columns[4].Width = 0;    // Sensor Data MSW
                this.listView1.Columns[5].Width = 0;    // Sensor Data LSW
                this.listView1.Columns[6].Width = 0;    // UTC MSW
                this.listView1.Columns[7].Width = 0;    // UTC LSW
                this.listView1.Columns[8].Width = 0;    // Start Time MSW
                this.listView1.Columns[9].Width = 0;    // Start Time LSW
            }
        }

        private void radioButton1_CheckedChanged(object sender, EventArgs e)
        {
            if (radioButton1.Checked == true)
            {
                this.listView1.Columns[0].Width = 260;  // EPC
                this.listView1.Columns[1].Width = 0;   
                this.listView1.Columns[2].Width = 0;
                this.listView1.Columns[3].Width = 30;   // Battery Alert
                this.listView1.Columns[4].Width = 0;    // Sensor Data MSW
                this.listView1.Columns[5].Width = 0;    // Sensor Data LSW
                this.listView1.Columns[6].Width = 0;    // UTC MSW
                this.listView1.Columns[7].Width = 0;    // UTC LSW
                this.listView1.Columns[8].Width = 0;    // Start Time MSW
                this.listView1.Columns[9].Width = 0;    // Start Time LSW
            }
        }

        private void tabControl1_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (Program.ReaderCE.State != RFState.IDLE)
            {
                btn_start.Text = "Start";
                Program.ReaderCE.StopOperation(true);

                radioButton1.Enabled = true;
                radioButton2.Enabled = true;
            }

            if (tabControl1.SelectedIndex == 2)
                this.Close();

            if (listView1.SelectedIndices.Count > 0)
            {
                int a = listView1.SelectedIndices[0];
                textBox1.Text = listView1.Items[a].SubItems[0].Text;
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Program.ReaderCE.Options.TagSelected.flags = SelectMaskFlags.ENABLE_TOGGLE;
            //Comment:If enable PC lock, please make sure you are not using Higgs3 Tag. Otherwise, write will fail
            Program.ReaderCE.Options.TagSelected.epcMask = new S_MASK(textBox1.Text);
            Program.ReaderCE.Options.TagSelected.epcMaskLength = (uint)Program.ReaderCE.Options.TagSelected.epcMask.Length * 8;

            if (Program.ReaderCE.StartOperation(Operation.TAG_SELECTED, true) != Result.OK)
            {
                MessageBox.Show("Selected tag failed");
                return;
            }

            // Start Monitoring
            Program.ReaderCE.Options.TagWriteUser.retryCount = 30;
            Program.ReaderCE.Options.TagWriteUser.accessPassword = UInt32.Parse(textBox2.Text);
            Program.ReaderCE.Options.TagWriteUser.offset = 238;
            Program.ReaderCE.Options.TagWriteUser.count = 1;
            Program.ReaderCE.Options.TagWriteUser.pData = Hex.ToUshorts("0406");
            if (Program.ReaderCE.StartOperation(Operation.TAG_WRITE_USER, true) != Result.OK)
            {
                MessageBox.Show("Cannot Stop Monitor");
                return;
            }

            MessageBox.Show("Stop Monitor Success");
        }

        public static DateTime ConvertFromUnixTimestamp(double timestamp)
        {
            DateTime origin = new DateTime(1970, 1, 1, 0, 0, 0, 0);
            return origin.AddSeconds(timestamp);
        }

        public static UInt32 ConvertToUnixTimestamp(DateTime date)
        {
            DateTime origin = new DateTime(1970, 1, 1, 0, 0, 0, 0);
            TimeSpan diff = date.ToUniversalTime() - origin;
            return (UInt32)diff.TotalSeconds;
        }
        
        void ViewDetail ()
        {
            UInt16 SensorDataMsw, SensorDataLsw;
            DateTime D10, D11;
            UInt32 StartTime, AlarmTime;

            if (!radioButton2.Checked)
                return;
            
            if (listView1.SelectedIndices.Count <= 0)
                return;

            SensorDataMsw = UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[4].Text);
            SensorDataLsw = UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[5].Text);

            StartTime = (UInt32)((UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[8].Text) << 16) | UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[9].Text));
            AlarmTime = (UInt32)(((UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[6].Text) ^ 0x8000) << 16) | UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[7].Text));

            D10 = ConvertFromUnixTimestamp(StartTime);
            D11 = D10.AddSeconds(AlarmTime);
            
            FormColdChainDetail Detail = new FormColdChainDetail();

            if ((SensorDataMsw & 0x0400) != 0)
                Detail.textBoxD1.Text = "Enable";
            else
                Detail.textBoxD1.Text = "Disable";

            if ((SensorDataMsw & 0x1000) != 0)
                Detail.textBoxD2.Text = "Fail";
            else
                Detail.textBoxD2.Text = "OK";

            if ((SensorDataMsw & 0x2000) != 0)
                Detail.textBoxD3.Text = "Fail";
            else
                Detail.textBoxD3.Text = "OK";

            if ((SensorDataMsw & 0x0200) != 0)
                Detail.textBoxD4.Text = "SS";
            else
                Detail.textBoxD4.Text = "notSS";

            if ((SensorDataMsw & 0x4000) != 0)
                Detail.textBoxD5.Text = "1";
            else
                Detail.textBoxD5.Text = "0";

            if ((SensorDataMsw & 0x0800) != 0)
                Detail.textBoxD6.Text = "1";
            else
                Detail.textBoxD6.Text = "0";

            Detail.textBoxD7.Text = (SensorDataLsw >> 10).ToString ();

            Detail.textBoxD8.Text = ((SensorDataLsw >> 5) & 0x1f).ToString();

            Detail.textBoxD9.Text = (SensorDataLsw & 0x1f).ToString();

            Detail.textBoxD10.Text = D10.ToString ();

            Detail.textBoxD11.Text = D11.ToString ();


            Detail.Show();
        }
        
        private void listView1_SelectedIndexChanged(object sender, EventArgs e)
        {
            ViewDetail ();
#if nouse            
            UInt16 SensorDataMsw, SensorDataLsw;
            DateTime D10, D11;
            UInt32 StartTime, AlarmTime;

            if (!radioButton2.Checked)
                return;
            
            if (listView1.SelectedIndices.Count <= 0)
                return;

            SensorDataMsw = UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[4].Text);
            SensorDataLsw = UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[5].Text);

            StartTime = (UInt32)((UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[8].Text) << 16) | UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[9].Text));
            AlarmTime = (UInt32)(((UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[6].Text) ^ 0x8000) << 16) | UInt16.Parse(listView1.Items[listView1.SelectedIndices[0]].SubItems[7].Text));

            D10 = ConvertFromUnixTimestamp(StartTime);
            D11 = D10.AddSeconds(AlarmTime);
            
            FormEM4325Detail Detail = new FormEM4325Detail();

            if ((SensorDataMsw & 0x0400) != 0)
                Detail.textBoxD1.Text = "Enable";
            else
                Detail.textBoxD1.Text = "Disable";

            if ((SensorDataMsw & 0x1000) != 0)
                Detail.textBoxD2.Text = "Fail";
            else
                Detail.textBoxD2.Text = "OK";

            if ((SensorDataMsw & 0x2000) != 0)
                Detail.textBoxD3.Text = "Fail";
            else
                Detail.textBoxD3.Text = "OK";

            if ((SensorDataMsw & 0x0200) != 0)
                Detail.textBoxD4.Text = "SS";
            else
                Detail.textBoxD4.Text = "notSS";

            if ((SensorDataMsw & 0x4000) != 0)
                Detail.textBoxD5.Text = "1";
            else
                Detail.textBoxD5.Text = "0";

            if ((SensorDataMsw & 0x0800) != 0)
                Detail.textBoxD6.Text = "1";
            else
                Detail.textBoxD6.Text = "0";

            Detail.textBoxD7.Text = (SensorDataLsw >> 10).ToString ();

            Detail.textBoxD8.Text = ((SensorDataLsw >> 5) & 0x1f).ToString();

            Detail.textBoxD9.Text = (SensorDataLsw & 0x1f).ToString();

            Detail.textBoxD10.Text = D10.ToString ();

            Detail.textBoxD11.Text = D11.ToString ();


            Detail.Show();
#endif
        }

        private void textBox4_LostFocus(object sender, EventArgs e)
        {
            Double value;

            try
            {
                value = Double.Parse(textBox4.Text);

                if (value < -63.75)
                    value = -63.75;
                else if (value > 63.75)
                    value = 63.75;

                textBox4.Text = value.ToString();
            }
            catch (Exception)
            {
                textBox4.Text = "0";
            }
        }

        private void textBox3_LostFocus(object sender, EventArgs e)
        {
            Double value;

            try
            {
                value = Double.Parse(textBox3.Text);

                if (value < -63.75)
                    value = -63.75;
                else if (value > 63.75)
                    value = 63.75;

                textBox3.Text = value.ToString();
            }
            catch (Exception)
            {
                textBox3.Text = "0";
            }
        }

        private void listView1_SelectedIndexChanged(object sender, ColumnClickEventArgs e)
        {
            ViewDetail ();
         }

        private void listView1_GotFocus(object sender, EventArgs e)
        {
            ViewDetail();
        }
    }
}
