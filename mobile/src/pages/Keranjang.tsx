
import { useEffect, useState } from 'react';
import {
  IonContent,
  IonPage,
  IonButton,
} from '@ionic/react';
import { useNavigate } from 'react-router-dom';
import { apiRequest } from '../services/api';
import './Keranjang.css';

interface MenuItem {
  id_menu: number;
  nama_menu: string;
  harga: number;
  status_menu: string;
  status_stok: string;
  tersedia_dipesan: boolean;
}

const MenuTersedia = (menu: MenuItem) =>
  menu.tersedia_dipesan === true;

const Keranjang: React.FC = () => {
  const navigate = useNavigate();

  const [daftarMenu, setDaftarMenu] = useState<MenuItem[]>([]);
  const [jumlah, setJumlah] = useState<Record<number, number>>(() => {
    try {
      return JSON.parse(localStorage.getItem('keranjang_senja') || '{}');
    } catch {
      return {};
    }
  });

  const [nomorMeja, setNomorMeja] = useState('');
  const [metodePembayaran, setMetodePembayaran] = useState('');
  const [checkoutLoading, setCheckoutLoading] = useState(false);
  const [menuLoading, setMenuLoading] = useState(true);

  useEffect(() => {
    const ambilMenu = async () => {
      try {
        const hasil = await apiRequest('/menu');
        setDaftarMenu(Array.isArray(hasil) ? hasil : hasil.data ?? []);
      } catch (error) {
        console.error('Gagal mengambil menu:', error);
        alert('Gagal memuat menu. Silakan coba lagi.');
      } finally {
        setMenuLoading(false);
      }
    };

    ambilMenu();
  }, []);

  const simpanKeranjang = (data: Record<number, number>) => {
    setJumlah(data);
    localStorage.setItem('keranjang_senja', JSON.stringify(data));
  };

  const tambah = (id: number) => {
    const menu = daftarMenu.find((item) => item.id_menu === id);

    if (!menu || !MenuTersedia(menu)) return;

    simpanKeranjang({
      ...jumlah,
      [id]: (jumlah[id] || 0) + 1,
    });
  };

  const kurangi = (id: number) => {
    const baru = { ...jumlah };

    if (baru[id] > 1) {
      baru[id]--;
    } else {
      delete baru[id];
    }

    simpanKeranjang(baru);
  };

  const hapus = (id: number) => {
    const baru = { ...jumlah };
    delete baru[id];
    simpanKeranjang(baru);
  };

  const itemKeranjang = daftarMenu.filter(
    (item) => jumlah[item.id_menu] > 0
  );

  const adaMenuTidakTersedia = itemKeranjang.some(
    (item) => !MenuTersedia(item)
  );

  const subtotal = itemKeranjang.reduce(
    (total, item) =>
      total + Number(item.harga) * jumlah[item.id_menu],
    0
  );

  const totalItem = Object.values(jumlah).reduce(
    (total, angka) => total + angka,
    0
  );

  const handleCheckout = async () => {
    if (menuLoading) return;

    if (itemKeranjang.length === 0) {
      alert('Keranjang masih kosong.');
      return;
    }

    if (adaMenuTidakTersedia) {
      alert('Hapus menu yang sedang tidak tersedia sebelum checkout.');
      return;
    }

    if (!nomorMeja) {
      alert('Silakan pilih nomor meja terlebih dahulu.');
      return;
    }

    if (!metodePembayaran) {
      alert('Silakan pilih metode pembayaran terlebih dahulu.');
      return;
    }

    const token = localStorage.getItem('pelanggan_token');

    if (!token) {
      alert('Silakan login terlebih dahulu.');
      navigate('/login');
      return;
    }

    try {
      setCheckoutLoading(true);

      const hasil = await apiRequest(
        '/pelanggan/pesanan',
        'POST',
        {
          nomor_meja: nomorMeja,
          metode_pembayaran: metodePembayaran,
          detail: itemKeranjang.map((item) => ({
            id_menu: item.id_menu,
            jumlah: jumlah[item.id_menu],
          })),
        },
        token
      );

      localStorage.removeItem('keranjang_senja');
      setJumlah({});

      alert(hasil.message || 'Pesanan berhasil dibuat!');
      navigate('/riwayat-pesanan', { replace: true });

    } catch (error) {
      alert(
        error instanceof Error
          ? error.message
          : 'Checkout gagal. Silakan coba lagi.'
      );
    } finally {
      setCheckoutLoading(false);
    }
  };

  return (
    <IonPage>
      <IonContent fullscreen className="cart-content">
        <div className="cart-header">
          <button onClick={() => navigate('/menu')}>
            ‹ Kembali
          </button>
          <p>KEDAI KOPI SENJA</p>
          <h1>Keranjang</h1>
          <span>{totalItem} item pilihanmu</span>
        </div>

        <div className="cart-container">
          {menuLoading ? (
            <div className="cart-empty">
              <h2>Memuat keranjang...</h2>
            </div>
          ) : itemKeranjang.length === 0 ? (
            <div className="cart-empty">
              <h2>Keranjang masih kosong</h2>
              <p>Yuk, pilih kopi dan makanan favoritmu!</p>
              <IonButton onClick={() => navigate('/menu')}>
                Lihat Menu
              </IonButton>
            </div>
          ) : (
            <>
              <h2>Pesanan Kamu</h2>

              {itemKeranjang.map((item) => {
                const tersedia = MenuTersedia(item);

                return (
                  <div className="cart-card" key={item.id_menu}>
                    <div className="cart-info">
                      <h3>{item.nama_menu}</h3>

                      {!tersedia && (
                        <span className="cart-unavailable">
                          Tidak Tersedia
                        </span>
                      )}

                      <strong>
                        Rp {Number(item.harga).toLocaleString('id-ID')}
                      </strong>

                      <button
                        className="cart-delete"
                        onClick={() => hapus(item.id_menu)}
                      >
                        Hapus
                      </button>
                    </div>

                    <div className="cart-quantity">
                      <button onClick={() => kurangi(item.id_menu)}>
                        −
                      </button>

                      <span>{jumlah[item.id_menu]}</span>

                      <button
                        onClick={() => tambah(item.id_menu)}
                        disabled={!tersedia}
                      >
                        +
                      </button>
                    </div>
                  </div>
                );
              })}

              {/* PILIH NOMOR MEJA */}
              <div className="cart-summary">
                <h2>Nomor Meja</h2>
                <p>Silakan pilih meja tempat kamu duduk.</p>

                <select
                  value={nomorMeja}
                  onChange={(e) => setNomorMeja(e.target.value)}
                  style={{
                    width: '100%',
                    padding: '13px',
                    borderRadius: '12px',
                    border: '1px solid #E8D6C8',
                    background: '#FFFAF6',
                    color: '#343B64',
                    marginBottom: '20px',
                  }}
                >
                  <option value="">Pilih Nomor Meja</option>
                  {Array.from({ length: 10 }, (_, i) => (
                    <option key={i + 1} value={`Meja ${String(i + 1).padStart(2, '0')}`}>
                      Meja {String(i + 1).padStart(2, '0')}
                    </option>
                  ))}
                </select>

                {/* PILIH PEMBAYARAN */}
                <h2>Metode Pembayaran</h2>
                <div style={{ display: 'flex', gap: '12px', marginBottom: '20px' }}>
                  <button
                    type="button"
                    onClick={() => setMetodePembayaran('QRIS')}
                    style={{
                      flex: 1,
                      padding: '14px',
                      borderRadius: '12px',
                      border: metodePembayaran === 'QRIS'
                        ? '2px solid #343B64'
                        : '1px solid #E8D6C8',
                      background: metodePembayaran === 'QRIS'
                        ? '#E4E3EF'
                        : '#FFFAF6',
                      color: '#343B64',
                      fontWeight: 600,
                    }}
                  >
                    QRIS
                  </button>

                  <button
                    type="button"
                    onClick={() => setMetodePembayaran('Tunai')}
                    style={{
                      flex: 1,
                      padding: '14px',
                      borderRadius: '12px',
                      border: metodePembayaran === 'Tunai'
                        ? '2px solid #343B64'
                        : '1px solid #E8D6C8',
                      background: metodePembayaran === 'Tunai'
                        ? '#E4E3EF'
                        : '#FFFAF6',
                      color: '#343B64',
                      fontWeight: 600,
                    }}
                  >
                    Tunai
                  </button>
                </div>

                <div className="cart-total-row">
                  <span>Subtotal</span>
                  <strong>
                    Rp {subtotal.toLocaleString('id-ID')}
                  </strong>
                </div>

                {adaMenuTidakTersedia && (
                  <p className="cart-warning">
                    Ada menu yang sedang tidak tersedia. Hapus menu tersebut
                    untuk melanjutkan checkout.
                  </p>
                )}

                <IonButton
                  expand="block"
                  className="checkout-button"
                  onClick={handleCheckout}
                  disabled={
                    checkoutLoading ||
                    menuLoading ||
                    adaMenuTidakTersedia
                  }
                >
                  {checkoutLoading
                    ? 'Memproses Pesanan...'
                    : adaMenuTidakTersedia
                      ? 'Menu Tidak Tersedia'
                      : 'Lanjut Checkout'}
                </IonButton>
              </div>
            </>
          )}
        </div>
      </IonContent>
    </IonPage>
  );
};

export default Keranjang;
