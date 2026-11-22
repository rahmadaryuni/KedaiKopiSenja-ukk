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
}

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

  const [checkoutLoading, setCheckoutLoading] = useState(false);

  useEffect(() => {
    const ambilMenu = async () => {
      try {
        const hasil = await apiRequest('/menu');
        setDaftarMenu(Array.isArray(hasil) ? hasil : hasil.data ?? []);
      } catch (error) {
        console.error('Gagal mengambil menu:', error);
      }
    };

    ambilMenu();
  }, []);

  const simpanKeranjang = (data: Record<number, number>) => {
    setJumlah(data);
    localStorage.setItem('keranjang_senja', JSON.stringify(data));
  };

  const tambah = (id: number) => {
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
    if (itemKeranjang.length === 0) {
      alert('Keranjang masih kosong.');
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
      navigate('/menu', { replace: true });

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
          {itemKeranjang.length === 0 ? (
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

              {itemKeranjang.map((item) => (
                <div className="cart-card" key={item.id_menu}>
                  <div className="cart-info">
                    <h3>{item.nama_menu}</h3>
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
                    <button onClick={() => tambah(item.id_menu)}>
                      +
                    </button>
                  </div>
                </div>
              ))}

              <div className="cart-summary">
                <h2>Ringkasan Pesanan</h2>

                <div className="cart-total-row">
                  <span>Subtotal</span>
                  <strong>
                    Rp {subtotal.toLocaleString('id-ID')}
                  </strong>
                </div>

                <IonButton
                  expand="block"
                  className="checkout-button"
                  onClick={handleCheckout}
                  disabled={checkoutLoading}
                >
                  {checkoutLoading
                    ? 'Memproses Pesanan...'
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
