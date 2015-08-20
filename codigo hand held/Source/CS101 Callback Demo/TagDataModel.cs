using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;

using CSLibrary.Windows.UI;
using CSLibrary.Structures;
using CSLibrary.Device;

namespace CS101_CALLBACK_API_DEMO
{
    [Flags]
    public enum SlowFlags
    {
        NONE = 0,
        INDEX = 1,
        PC = 2,
        EPC = 4,
        RSSI = 8,
        COUNT = 16,
        ALL = PC | EPC | RSSI | COUNT | INDEX
    }
    public enum SortIndex
    {
        INDEX,
        PC,
        EPC,
        RSSI,
        COUNT,
        USER1,
        
    }
    class TagDataModel : INTableModel
    {
        private object myLock = new object();

        public SortIndex SortMethod = SortIndex.EPC;
        public bool Ascending = true;
        
        public String[] m_displayColumnName;
        private Type[] m_columnType;
        private SlowFlags[] m_columnFlag;

        #region ITableModel Members
        private List<TagCallbackInfo> m_items = new List<TagCallbackInfo>();

        private SlowFlags flags = SlowFlags.ALL;

        public TagDataModel(SlowFlags flag)
        {
            SetDisplayColumnName(flags = flag);
        }

        public TagDataModel(List<TagCallbackInfo> data, SlowFlags flag)
        {
            m_items = data;
            SetDisplayColumnName(flags = flag);
        }

        private void SetDisplayColumnName(SlowFlags flag)
        {
            int index = 0;
            m_displayColumnName = new string[GetColumnCount()];
            m_columnType = new Type[GetColumnCount()];
            m_columnFlag = new SlowFlags[GetColumnCount()];
            if ((flags & SlowFlags.INDEX) == SlowFlags.INDEX)
            {
                m_displayColumnName[index] = "TIPO EPC";
                m_columnType[index] = typeof(String);
                m_columnFlag[index] = SlowFlags.INDEX;
                index++;
            }
            if ((flags & SlowFlags.PC) == SlowFlags.PC)
            {
                m_displayColumnName[index] = "PC";
                m_columnType[index] = typeof(String);
                m_columnFlag[index] = SlowFlags.PC;
                index++;
            }   
            if ((flags & SlowFlags.EPC) == SlowFlags.EPC)
            {
                m_displayColumnName[index] = "EPC";
                m_columnType[index] = typeof(String);
                m_columnFlag[index] = SlowFlags.EPC;
                index++;
            }
            if ((flags & SlowFlags.RSSI) == SlowFlags.RSSI)
            {
                m_displayColumnName[index] = "RSSI";
                m_columnType[index] = typeof(float);
                m_columnFlag[index] = SlowFlags.RSSI;
                index++;
            }
            if ((flags & SlowFlags.COUNT) == SlowFlags.COUNT)
            {
                m_displayColumnName[index] = "CNT";
                m_columnType[index] = typeof(int);
                m_columnFlag[index] = SlowFlags.COUNT;
            }     
        }

        public int GetRowCount()
        {
            lock (myLock)
            {
                return m_items.Count;
            }
        }

        public int GetColumnCount()
        {
            int Count = 0;//at least 1 Column
            if ((flags & SlowFlags.ALL) == SlowFlags.ALL)
            {
                return 5;
            }
            if ((flags & SlowFlags.INDEX) == SlowFlags.INDEX)
            {
                Count++;
            }
            if ((flags & SlowFlags.COUNT) == SlowFlags.COUNT)
            {
                Count++;
            }
            if ((flags & SlowFlags.EPC) == SlowFlags.EPC)
            {
                Count++;
            }
            if ((flags & SlowFlags.PC) == SlowFlags.PC)
            {
                Count++;
            }
            if ((flags & SlowFlags.RSSI) == SlowFlags.RSSI)
            {
                Count++;
            }
            return Count;/*Index-EPC-RSSI*/
        }

        public string GetColumnName(int columnIndex)
        {
            return m_displayColumnName[columnIndex];
        }

        public Type GetColumnClass(int columnIndex)
        {
            return m_columnType[columnIndex];
        }

        public bool IsCellEditable(int rowIndex, int columnIndex)
        {
            return false;
        }

        public object GetValueAt(int rowIndex, int columnIndex)
        {
            lock (myLock)
            {
                switch (m_columnFlag[columnIndex])
                {
                    case SlowFlags.COUNT: return m_items[rowIndex].count;
                    case SlowFlags.EPC: return m_items[rowIndex].epc;
                    case SlowFlags.INDEX: return m_items[rowIndex].epc.ToString().Substring(0,2);
                    case SlowFlags.PC: return m_items[rowIndex].pc;
                    case SlowFlags.RSSI: return m_items[rowIndex].rssi;
                    default: return String.Empty;
                }
            }
        }

        public void SetValueAt(object aValue, int rowIndex, int columnIndex)
        {
        }
        public object GetObjectAt(int rowIndex, int columnIndex)
        {
            return null;
        }

        public event TableModelChangeHandler Change;   
        #endregion

        public List<TagCallbackInfo> Items
        {
            get { lock (myLock) { return m_items; } }
            set { lock (myLock) { m_items = value; } }
        }

        public void UpdateItem(TagCallbackInfo info, int index)
        {
            lock (myLock)
            {
                m_items[index] = info;
            }
        }

        public void Redraw()
        {
            if (Change != null)
            {
                Change.Invoke();
            }
        }

        public void AddItem(TagCallbackInfo newElement)
        {
            //lock (myLock)
            if (!Monitor.TryEnter(myLock))
                return;
            {
                TagCallbackInfo info = m_items.Find(delegate(TagCallbackInfo found) { return (found.epc.CompareTo(newElement.epc) == 0); });
                if (info != null)
                {
                    m_items[info.index].rssi = newElement.rssi;
                }
                else
                {
                    //Finally do the insert by delegating to "InsertAt"
                    newElement.index = m_items.Count;
                    m_items.Add(newElement);
                    Device.BuzzerOn(2000, 40, BuzzerVolume.HIGH);
                }
            }
            Monitor.Exit(myLock);
            Sort();
        }
        public void Add(TagCallbackInfo newElement)
        {
            //lock (myLock)
            if (!Monitor.TryEnter(myLock))
                return;
            {
                TagCallbackInfo info = m_items.Find(delegate(TagCallbackInfo found) { return (found.epc.CompareTo(newElement.epc) == 0); });
                if (info != null)
                {
                    m_items[info.index].rssi = newElement.rssi;
                }
                else
                {
                    //Finally do the insert by delegating to "InsertAt"
                    newElement.index = m_items.Count;
                    m_items.Add(newElement);
                    Device.BuzzerOn(2000, 40, BuzzerVolume.HIGH);
                }
            }
            Monitor.Exit(myLock);
            if (Change != null)
                Change.Invoke();
        }
        public void Clear()
        {
            lock(myLock)
            {
                m_items.Clear();
            }
            if (Change != null)
                Change.Invoke();
        }

        public void Sort()
        {
            Monitor.Enter(myLock);
            switch (SortMethod)
            {
                case SortIndex.EPC:
                    m_items.Sort(new LvEpcSorter(Ascending));
                    break;
                case SortIndex.COUNT:
                    m_items.Sort(new LvCntSorter(Ascending));
                    break;
                case SortIndex.INDEX:
                    m_items.Sort(new LvIndexSorter(Ascending));
                    break;
                case SortIndex.PC:
                    m_items.Sort(new LvPcSorter(Ascending));
                    break;
                case SortIndex.RSSI:
                    m_items.Sort(new LvRssiSorter(Ascending));
                    break;
            }
            Monitor.Exit(myLock);
        }

        private class LvEpcSorter : IComparer<TagCallbackInfo>
        {
            private bool Ascending = false;
            public LvEpcSorter(bool ascending)
            {
                Ascending = ascending;
            }

            public int Compare(TagCallbackInfo obj1, TagCallbackInfo obj2)
            {
                int nResult = obj2.epc.CompareTo(obj1.epc);
                if (nResult != 0)
                {
                    nResult = Ascending ? nResult : -nResult;
                }
                return nResult;
            }
        }
        private class LvCntSorter : IComparer<TagCallbackInfo>
        {
            private bool Ascending = false;
            public LvCntSorter(bool ascending)
            {
                Ascending = ascending;
            }
            public int Compare(TagCallbackInfo obj1, TagCallbackInfo obj2)
            {
                int nResult = ((TagCallbackInfo)obj2).count.CompareTo(((TagCallbackInfo)obj1).count);
                if (nResult != 0)
                {
                    nResult = Ascending ? -nResult : nResult;
                }
                return nResult;
            }
        }
        private class LvRssiSorter : IComparer<TagCallbackInfo>
        {
            private bool Ascending = false;
            public LvRssiSorter(bool ascending)
            {
                Ascending = ascending;
            }
            public int Compare(TagCallbackInfo obj1, TagCallbackInfo obj2)
            {
                int nResult = ((TagCallbackInfo)obj2).rssi.CompareTo(((TagCallbackInfo)obj1).rssi);
                if (nResult != 0)
                {
                    nResult = Ascending ? -nResult : nResult;
                }
                return nResult;
            }
        }
        private class LvIndexSorter : IComparer<TagCallbackInfo>
        {
            private bool Ascending = false;
            public LvIndexSorter(bool ascending)
            {
                Ascending = ascending;
            }
            public int Compare(TagCallbackInfo obj1, TagCallbackInfo obj2)
            {
                int nResult = ((TagCallbackInfo)obj2).index.CompareTo(((TagCallbackInfo)obj1).index);
                if (nResult != 0)
                {
                    nResult = Ascending ? -nResult : nResult;
                }
                return nResult;
            }
        }
        private class LvPcSorter : IComparer<TagCallbackInfo>
        {
            private bool Ascending = false;
            public LvPcSorter(bool ascending)
            {
                Ascending = ascending;
            }
            public int Compare(TagCallbackInfo obj1, TagCallbackInfo obj2)
            {
                int nResult = ((TagCallbackInfo)obj2).pc.CompareTo(((TagCallbackInfo)obj1).pc);
                if (nResult != 0)
                {
                    nResult = Ascending ? -nResult : nResult;
                }
                return nResult;
            }
        }

    }
}
