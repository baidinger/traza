using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Drawing;
using System.Data;
using System.Text;
using System.Windows.Forms;

namespace CS101_CALLBACK_API_DEMO
{
    public partial class StartMenu : UserControl
    {
        private bool bToggleStartButton = false;

        private bool isHideMenu = false;

        private bool isSelectable = false;
        private SlowFlags mShowSortFlag = SlowFlags.NONE;

        public delegate void ButtonClickArgs(ButtonClickType type);
        public event ButtonClickArgs OnButtonClick;

        public bool IsSelectable
        {
            get { return isSelectable; }
            set { isSelectable = value; }
        }

        public bool IsHideMenu
        {
            get { return isHideMenu; }
        }

        public SlowFlags ShowSortFlag
        {
            get { return mShowSortFlag; }
            set {
                cb_sorting.BeginUpdate();
                cb_sorting.Items.Clear();
                mShowSortFlag = value;
                if ((mShowSortFlag & SlowFlags.INDEX) != 0)
                {
                    cb_sorting.Items.Add("ID(Ascending)");
                    cb_sorting.Items.Add("ID(Descending)");
                }
                if ((mShowSortFlag & SlowFlags.PC) != 0)
                {
                    cb_sorting.Items.Add("PC(Ascending)");
                    cb_sorting.Items.Add("PC(Descending)");
                }
                if ((mShowSortFlag & SlowFlags.EPC) != 0)
                {
                    cb_sorting.Items.Add("EPC(Ascending)");
                    cb_sorting.Items.Add("EPC(Descending)");
                }
                if ((mShowSortFlag & SlowFlags.RSSI) != 0)
                {
                    cb_sorting.Items.Add("RSSI(Ascending)");
                    cb_sorting.Items.Add("RSSI(Descending)");
                }
                if ((mShowSortFlag & SlowFlags.COUNT) != 0)
                {
                    cb_sorting.Items.Add("CNT(Ascending)");
                    cb_sorting.Items.Add("CNT(Descending)");
                }
                cb_sorting.SelectedIndex = (value == SlowFlags.NONE ? - 1 : 0);
                cb_sorting.EndUpdate();
            }
        }


        public Sorting SortingMethod
        {
            get {
                switch (cb_sorting.Items[cb_sorting.SelectedIndex].ToString())
                {
                    case "ID(Ascending)":
                        return Sorting.INDEX_Ascending;
                    case "ID(Descending)":
                        return Sorting.INDEX_Decending;
                    case "PC(Ascending)":
                        return Sorting.PC_Ascending;
                    case "PC(Descending)":
                        return Sorting.PC_Decending;
                    case "EPC(Ascending)":
                        return Sorting.EPC_Ascending;
                    case "EPC(Descending)":
                        return Sorting.EPC_Decending;
                    case "RSSI(Ascending)":
                        return Sorting.RSSI_Ascending;
                    case "RSSI(Descending)":
                        return Sorting.RSSI_Decending;
                    case "CNT(Ascending)":
                        return Sorting.COUNT_Ascending;
                    case "CNT(Descending)":
                        return Sorting.COUNT_Decending;
                }
                return Sorting.NONE; ;
            }
        }

        public StartMenu()
        {
            InitializeComponent();

            cb_sorting.SelectedIndex = 0;
        }

        private void lk_hideMenu_Click(object sender, EventArgs e)
        {
            if (isHideMenu)
            {
                lk_hideMenu.Text = "Ocultar Menu";
                this.Location = new Point(0, 180);
                this.Height = 60;
                isHideMenu = false;

            }
            else
            {
                lk_hideMenu.Text = "Mostrar Menu";
                this.Location = new Point(0, 210);
                this.Height = 30;
                isHideMenu = true;
            }
            if (OnButtonClick != null)
            {
                OnButtonClick(isHideMenu ? ButtonClickType.Hide : ButtonClickType.Unhide);
            }
        }

        private void btn_start_Click(object sender, EventArgs e)
        {
            if(OnButtonClick !=null)
            {
                OnButtonClick(bToggleStartButton ? ButtonClickType.Stop : ButtonClickType.Start);
            }
        }

        private void btn_clear_Click(object sender, EventArgs e)
        {
            if (OnButtonClick != null)
            {
                OnButtonClick(ButtonClickType.Clear);
            }
        }

        private void btn_save_Click(object sender, EventArgs e)
        {
            if (OnButtonClick != null)
            {
                OnButtonClick(ButtonClickType.Save);
            }
        }

        private void btn_exit_Click(object sender, EventArgs e)
        {
            if (OnButtonClick != null)
            {
                OnButtonClick(ButtonClickType.Exit);
            }
        }

        public void ToggleStartButton()
        {
            this.Invoke((System.Threading.ThreadStart)delegate()
            {
                if (bToggleStartButton)
                {
                    btn_start.BackColor = Color.FromArgb(0, 192, 0);
                    btn_start.Text = "Start";
                    bToggleStartButton = false;
                    btn_clear.Enabled = btn_exit.Enabled = btn_save.Enabled = cb_sorting.Enabled = true;
                }
                else
                {
                    btn_start.BackColor = Color.Red;
                    btn_start.Text = "Stop";
                    bToggleStartButton = true;
                    btn_clear.Enabled = btn_exit.Enabled = btn_save.Enabled = cb_sorting.Enabled = false;
                }
            });
            
        }


        public void UpdateTagCount(int info)
        {
            this.Invoke((System.Threading.ThreadStart)delegate()
            {
                lb_tagFound.Text = info.ToString();
            });
        }

        public void UpdateTagRate(int info)
        {
            this.Invoke((System.Threading.ThreadStart)delegate()
             {
                 lb_rate.Text = info.ToString();
                 linkLabel1.Text = "Tag/s";
             });
        }


        public void UpdateTimeElapsed(double sec)
        {
            this.Invoke((System.Threading.ThreadStart)delegate()
             {
                 lb_rate.Text = sec.ToString("F0");
                 linkLabel1.Text = "sec";
             });
        }

        public void UpdateTimeElapsed(String sec)
        {
            this.Invoke((System.Threading.ThreadStart)delegate()
            {
                lb_rate.Text = sec;
                linkLabel1.Text = "sec";
            });
        }

        public void UpdateStartBtn(bool select)
        {
            this.Invoke((System.Threading.ThreadStart)delegate()
             {
                 btn_start.Text = select ? "Select" : "Start";
             });
        }

        private void cb_sorting_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (OnButtonClick != null)
            {
                OnButtonClick(ButtonClickType.Sorting);
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (OnButtonClick != null)
            {
                OnButtonClick(ButtonClickType.Finalizar);
            }
        }
    }

    public enum Sorting
    {
        INDEX_Ascending,
        INDEX_Decending,
        PC_Ascending,
        PC_Decending,
        EPC_Ascending,
        EPC_Decending,
        RSSI_Ascending,
        RSSI_Decending,
        COUNT_Ascending,
        COUNT_Decending,
        NONE
    }

    public enum ButtonClickType
    {
        Start,
        Finalizar,
        Stop,
        Save,
        Clear,
        Exit,
        Hide,
        Unhide,
        Sorting,
        Unknown
    };

}
