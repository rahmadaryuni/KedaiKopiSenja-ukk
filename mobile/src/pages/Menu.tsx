import {useNavigate} from 'react-router-dom';
import { useEffect, useMemo, useState } from 'react';
import {
  IonContent,
  IonPage,
  IonSpinner,
  IonSearchbar,
  IonButton,
} from '@ionic/react';
import { apiRequest } from '../services/api';
import './Menu.css';

interface MenuItem {
  id_menu: number;
  id_kategori: number;
  nama_menu: string;
  deskripsi?: string;
  harga: number;
  kategori?: {
    id_kategori: number;
    nama_kategori: string;
  };
}

const Menu: React.FC = () => {
  const [daftarMenu, setDaftarMenu] = useState<MenuItem[]>([]);
  const [pencarian, setPencarian] = useState('');
  const [kategoriAktif, setKategoriAktif] = useState<number | null>(null);
  const [keranjang, setKeranjang] = useState<Record<number, number>>({});
  const [loading, setLoading] = useState(true);
  const navigate = useNavigate();

  useEffect(() => {
    const ambilMenu = async () => {
      try {
        const hasil = await apiRequest('/menu');
        setDaftarMenu(Array.isArray(hasil) ? hasil : hasil.data ?? []);
      } catch (error) {
        console.error('Gagal mengambil menu:', error);
      } finally {
        setLoading(false);
      }
    };

    ambilMenu();
  }, []);

  const kategori = useMemo(() => {
    const daftar = new Map<number, string>();

    daftarMenu.forEach((item) => {
      if (item.kategori) {
        daftar.set(
          item.kategori.id_kategori,
          item.kategori.nama_kategori
        );
      }
    });

    return Array.from(daftar, ([id, nama]) => ({ id, nama }));
  }, [daftarMenu]);

    const tambahKeranjang = (idMenu: number) => {
    const baru = {
        ...keranjang,
        [idMenu]: (keranjang[idMenu] || 0) + 1,
    };

    setKeranjang(baru);
    localStorage.setItem('keranjang_senja', JSON.stringify(baru));
    };

  const totalItem = Object.values(keranjang).reduce(
    (total, jumlah) => total + jumlah,
    0
  );

  const menuFilter = daftarMenu.filter((item) => {
    const cocokNama = item.nama_menu
      .toLowerCase()
      .includes(pencarian.toLowerCase());

    const cocokKategori =
      kategoriAktif === null ||
      item.kategori?.id_kategori === kategoriAktif;

    return cocokNama && cocokKategori;
  });

  return (
    <IonPage>
      <IonContent fullscreen className="menu-content">
        <div className="menu-header">
          <p>KEDAI KOPI SENJA</p>
          <h1>Menu Kami</h1>
          <span>Temukan favoritmu hari ini</span>
        </div>

        <div className="menu-container">
          <IonSearchbar
            value={pencarian}
            onIonInput={(e) => setPencarian(e.detail.value ?? '')}
            placeholder="Cari menu favorit..."
            className="menu-search"
          />

          <h2>Kategori</h2>

          <div className="kategori-list">
            <button
              className={`kategori-button ${kategoriAktif === null ? 'active' : ''}`}
              onClick={() => setKategoriAktif(null)}
            >
              Semua
            </button>

            {kategori.map((item) => (
              <button
                key={item.id}
                className={`kategori-button ${kategoriAktif === item.id ? 'active' : ''}`}
                onClick={() => setKategoriAktif(item.id)}
              >
                {item.nama}
              </button>
            ))}
          </div>

          <div className="menu-title-row">
            <h2>Semua Menu</h2>
            <span>{menuFilter.length} menu</span>
          </div>

          {loading ? (
            <div className="menu-loading">
              <IonSpinner />
              <p>Memuat menu...</p>
            </div>
          ) : menuFilter.length === 0 ? (
            <p className="menu-empty">Menu tidak ditemukan.</p>
          ) : (
            <div className="menu-list">
              {menuFilter.map((item) => (
                <div className="menu-card" key={item.id_menu}>
                  <div className="menu-card-info">
                    <span>
                      {item.kategori?.nama_kategori ?? 'Menu Senja'}
                    </span>
                    <h3>{item.nama_menu}</h3>
                    <p>
                      {item.deskripsi || 'Menu pilihan Kedai Kopi Senja.'}
                    </p>
                    <strong>
                      Rp {Number(item.harga).toLocaleString('id-ID')}
                    </strong>
                  </div>

                  <div className="menu-card-action">
                    {keranjang[item.id_menu] > 0 && (
                      <span className="jumlah-menu">
                        {keranjang[item.id_menu]} dipilih
                      </span>
                    )}

                    <IonButton
                      size="small"
                      className="tambah-button"
                      onClick={() => tambahKeranjang(item.id_menu)}
                    >
                      + Tambah
                    </IonButton>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>

        {totalItem > 0 && (
          <div className="keranjang-bar">
            <div>
              <strong>{totalItem} item dipilih</strong>
              <span>Siap dimasukkan ke keranjang</span>
            </div>
            <IonButton
                className="keranjang-button"
                onClick={() => navigate('/keranjang')}
                >
                Keranjang
                </IonButton>
          </div>
        )}
      </IonContent>
    </IonPage>
  );
};

export default Menu;
