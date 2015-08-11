using System;
using System.Collections.Generic;
using System.Windows.Forms;
using System.Text;
using System.IO;
using System.Xml;
using System.Xml.Serialization;
using System.Diagnostics;

namespace CS101_CALLBACK_API_DEMO
{

    using CSLibrary;
    using CSLibrary.Device;
    using CSLibrary.Events;
    using CSLibrary.Constants;
    using CSLibrary.Structures;

    using CSLibrary.Barcode;
    using CSLibrary.Barcode.Constants;
    using CSLibrary.Barcode.Structures;

    using CSLibrary.Text;
    using CSLibrary.Tools;
    using System.Drawing;

    static class Program
    {
        public static HighLevelInterface ReaderCE = new HighLevelInterface();
        public static PowerForm Power = null;
        public static ProfileForm Profile = null;
        public static string applicationSettings = "application.config";
        //public static appSettings appSetting = new appSettings();
        public static appSettings appSetting;

        //GetVersion
        public static CSLibrary.Structures.Version rfidLibraryVersion = null;
        public static CSLibrary.Structures.Version driverVersion = null;
        public static CSLibrary.Structures.Version firmwareVersion = null;
        public static CSLibrary.Structures.Version cslibraryVersion = null;
        public static CSLibrary.Structures.Version hardwareVersion = null;
        public static string pcbAssemblyCode = null;
        public static string manufactureDate = null;
        public static string deviceName = null;
        public static string serialNumber = null;
        public static bool barcodemodule = false;

       
        public static string uri = "http://192.168.0.105/webservice/";

       // private static string appGuid = "WRITE AN UNIQUE GUID HERE";
       // private static System.Threading.Mutex mutex;
        
        /// <summary>
        /// The main entry point for the application.
        /// </summary>
        [MTAThread]
        static void Main()
        {
            string AppPath = System.IO.Path.GetDirectoryName(System.Reflection.Assembly.GetExecutingAssembly().GetName().CodeBase);
            applicationSettings = System.IO.Path.Combine(AppPath, applicationSettings);

/*
            using (System.Threading.Mutex mutex = new System.Threading.Mutex(false, appGuid)) {
        if (!mutex.WaitOne(0, false)) {
            MessageBox.Show("Instance already running", "ERROR", MessageBoxButtons.OK, MessageBoxIcon.Error);
            return;
        }
*/

          //  CSLibrary.Windows.UI.SplashScreen.Show(CSLibrary.Windows.UI.SplashScreen.CSL.CS101);
            //CSLibrary.Windows.UI.SplashScreen.Show(CSLibrary.Windows.UI.SplashScreen.CSL.CS101NOLOGO);
            using (trazabilidadSplash c = new trazabilidadSplash())
            {
                c.Location = new Point((320 - c.Width) / 2, (240 - c.Height) / 2);
                c.Show();
                c.Update();
                if (File.Exists("host.txt"))
                {
                    using (FileStream fs = new FileStream("host.txt", FileMode.Open))
                    using (StreamReader sr = new StreamReader(fs))
                    {
                        String host = sr.ReadLine();
                        sr.Close();

                        uri = "http://" + host + "/webservice/";
                    }

                }
                else
                {
                    using (FileStream fs = new FileStream("host.txt", FileMode.Create))
                    using (StreamWriter sw = new StreamWriter(fs))
                    {
                        sw.WriteLine("192.168.0.105");
                        sw.Flush();
                    }

                }



                //First Step
                FullScreen.Start();

                //turn on debug logging for debug purpose
                CSLibrary.Diagnostics.CoreDebug.Enable = true;

                if (ReaderCE.Connect() != CSLibrary.Constants.Result.OK)
                    MessageBox.Show("RFID Connect Fail");

                appSetting = new appSettings();

                if (Barcode.Connect() != CSLibrary.Barcode.Constants.Result.SUCCESS)
                {
                    using (BarCodeMessage BarCodeFail = new BarCodeMessage())
                    {
                        BarCodeFail.ShowDialog();
                    }
                }
                else
                    barcodemodule = true;

                Device.BarcodePowerOn();

                //Get All Reader information and Versions
                driverVersion = Program.ReaderCE.GetDriverVersion();
                firmwareVersion = Program.ReaderCE.GetFirmwareVersion();
                cslibraryVersion = Program.ReaderCE.GetCSLibraryVersion();
                rfidLibraryVersion = Program.ReaderCE.GetRfidLibraryVersion();
                hardwareVersion = Program.ReaderCE.GetHardwareVersion();
                pcbAssemblyCode = Program.ReaderCE.GetPCBAssemblyCode();
                manufactureDate = Program.ReaderCE.GetManufactureDate();
                serialNumber = Device.GetSerialNumber();
                deviceName = Device.GetDeviceName();

                if (barcodemodule == true && Barcode.EnableDisableSymbology(Symbol.ALL, true) != CSLibrary.Barcode.Constants.Result.SUCCESS)
                    MessageBox.Show("EnableDisableSymbology Fail");

                //Load Setting
                if (!System.IO.File.Exists(applicationSettings))
                {
                    SaveSettings();
                    LoadSettings();
                }
                else
                {
                    LoadSettings();
                }

                Power = new PowerForm();

                Profile = new ProfileForm();

                //Application.Run(new MenuForm());
                //Application.Run(new TagInventoryForm());
                //Application.Run(new sesion());

                Application.Run(new Trazabilidad());

                ReaderCE.Disconnect();

                Barcode.SetConfigItemToDefaults(ConfigItems.ALL_CONFIG);

                Barcode.Disconnect();

                FullScreen.Stop();
            }
           // CSLibrary.Windows.UI.SplashScreen.Stop();
        }

        public static CSLibrary.Structures.Version GetDemoVersion()
        {
            System.Version sver = System.Reflection.Assembly.GetExecutingAssembly().GetName().Version;
            CSLibrary.Structures.Version ver = new CSLibrary.Structures.Version();
            ver.major = (uint)sver.Major;
            ver.minor = (uint)sver.Minor;
            ver.patch = (uint)sver.Build;
            return ver;
        }

        #region Setting
        public static void LoadSettings()
        {
            appSetting = appSetting.Load();

            //Apply previous configuration
            if (ReaderCE.SetCurrentLinkProfile(appSetting.Link_profile) != CSLibrary.Constants.Result.OK)
            {
                MessageBox.Show(String.Format("SetCurrentLinkProfile rc = {0}", ReaderCE.LastResultCode));
                Application.Exit();
                return;
            }
            if (appSetting.FixedChannel)
            {
                if (ReaderCE.SetFixedChannel(appSetting.Region, appSetting.Channel_number, appSetting.Lbt ? LBT.ON : LBT.OFF) != CSLibrary.Constants.Result.OK)
                {
                    MessageBox.Show(String.Format("SetFixedChannel rc = {0}", ReaderCE.LastResultCode));
                    Application.Exit();
                    return;
                }
            }
            else
            {
                if (ReaderCE.SetHoppingChannels(appSetting.Region) != CSLibrary.Constants.Result.OK)
                {
                    MessageBox.Show(String.Format("SetHoppingChannels rc = {0}", ReaderCE.LastResultCode));
//                    Application.Exit();
//                    return;
                }
            }
            if (ReaderCE.SetSingulationAlgorithmParms(appSetting.Singulation, appSetting.SingulationAlg) != CSLibrary.Constants.Result.OK)
            {
                MessageBox.Show(String.Format("SetSingulationAlgorithmParms rc = {0}", ReaderCE.LastResultCode));
                Application.Exit();
                return;
            }
            if (ReaderCE.SetPowerLevel(appSetting.Power) != CSLibrary.Constants.Result.OK)
            {
                MessageBox.Show(String.Format("SetPowerLevel rc = {0}", ReaderCE.LastResultCode));
                Application.Exit();
                return;
            }
        }

        public static bool SaveSettings()
        {
            appSetting.Channel_number = ReaderCE.SelectedChannel;
            appSetting.Lbt = ReaderCE.LBT_ON == LBT.ON;
            appSetting.Link_profile = ReaderCE.SelectedLinkProfile;
            appSetting.Power = ReaderCE.SelectedPowerLevel;
            appSetting.Region = ReaderCE.SelectedRegionCode;
            appSetting.FixedChannel = ReaderCE.IsFixedChannel;
            return appSetting.Save();
        }
        #endregion
    }
}