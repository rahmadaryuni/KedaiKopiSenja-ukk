
import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  IonContent,
  IonPage,
  IonSpinner,
  IonButton,
  IonModal,
  IonHeader,
  IonToolbar,
  IonTitle,
  IonButtons,
} from '@ionic/react';
import { apiRequest } from '../services/api';
import './RiwayatPesanan.css';
import BottomNav from '../components/BottomNav';

interface DetailPesanan {
  id_detail_pesanan: number;
  jumlah: number;
  harga_satuan: number;
  subtotal: number;
  menu?: {
    nama_menu: string;
  };
}

interface Pesanan {
  id_pesanan: number;
  tanggal_pesanan: string;
  status_pesanan: string;
  subtotal: number;
  biaya_layanan: number;
  pajak: number;
  total_harga: number;
  nomor_meja?: string;
  metode_pembayaran?: string;
  detail_pesanan: DetailPesanan[];
}

const RiwayatPesanan: React.FC = () => {
  const [daftarPesanan, setDaftarPesanan] = useState<Pesanan[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [strukTerpilih, setStrukTerpilih] = useState<Pesanan | null>(null);

  const navigate = useNavigate();

  useEffect(() => {
    const ambilRiwayat = async () => {
      const token = localStorage.getItem('pelanggan_token');

      if (!token) {
        navigate('/login', { replace: true });
        return;
      }

      try {
        const hasil = await apiRequest(
          '/pelanggan/riwayat-pesanan',
          'GET',
          undefined,
          token
        );

        setDaftarPesanan(
          Array.isArray(hasil) ? hasil : hasil.data ?? []
        );
      } catch (err) {
        setError(
          err instanceof Error
            ? err.message
            : 'Gagal mengambil riwayat pesanan.'
        );
      } finally {
        setLoading(false);
      }
    };

    ambilRiwayat();
  }, [navigate]);

  const formatTanggal = (tanggal: string) => {
    if (!tanggal) return '-';

    return new Date(tanggal).toLocaleString('id-ID', {
      dateStyle: 'long',
      timeStyle: 'short',
    });
  };

  const formatRupiah = (nominal: number) =>
    `Rp ${Number(nominal || 0).toLocaleString('id-ID')}`;

  const classStatus = (status: string) =>
    status.toLowerCase().replace(/\s+/g, '-');

  return (
    <IonPage>
      <IonContent fullscreen className="riwayat-content">
        <div className="riwayat-header">
          <p>KEDAI KOPI SENJA</p>
          <h1>Riwayat Pesanan</h1>
          <span>Lihat perjalanan pesananmu bersama kami</span>
        </div>

        <div className="riwayat-container">
          <div className="riwayat-title-row">
            <span>{daftarPesanan.length} pesanan</span>
          </div>

          {loading ? (
            <div className="riwayat-loading">
              <IonSpinner />
              <p>Memuat riwayat pesanan...</p>
            </div>
          ) : error ? (
            <div className="riwayat-empty">
              <p>{error}</p>
              <IonButton
                className="riwayat-kembali"
                onClick={() => window.location.reload()}
              >
                Coba Lagi
              </IonButton>
            </div>
          ) : daftarPesanan.length === 0 ? (
            <div className="riwayat-empty">
              <h3>Belum Ada Pesanan</h3>
              <p>Pesanan yang kamu buat akan muncul di sini.</p>
              <IonButton
                className="riwayat-kembali"
                onClick={() => navigate('/menu')}
              >
                Lihat Menu
              </IonButton>
            </div>
          ) : (
            <div className="riwayat-list">
              {daftarPesanan.map((pesanan) => (
                <div className="riwayat-card" key={pesanan.id_pesanan}>
                  <div className="riwayat-card-header">
                    <div>
                      <span className="riwayat-label">Nomor Pesanan</span>
                      <h3>#{pesanan.id_pesanan}</h3>
                    </div>

                    <span
                      className={`riwayat-status ${classStatus(pesanan.status_pesanan)}`}
                    >
                      {pesanan.status_pesanan}
                    </span>
                  </div>

                  <p className="riwayat-tanggal">
                    {formatTanggal(pesanan.tanggal_pesanan)}
                  </p>

                  <div className="riwayat-detail">
                    {(pesanan.detail_pesanan ?? []).map((detail) => (
                      <div
                        className="riwayat-menu-item"
                        key={detail.id_detail_pesanan}
                      >
                        <div>
                          <strong>
                            {detail.menu?.nama_menu ?? 'Menu'}
                          </strong>
                          <span>{detail.jumlah} item</span>
                        </div>
                        <span>{formatRupiah(detail.subtotal)}</span>
                      </div>
                    ))}
                  </div>

                  <div className="riwayat-total">
                    <span>Total Pesanan</span>
                    <strong>{formatRupiah(pesanan.total_harga)}</strong>
                  </div>

                  <IonButton
                    expand="block"
                    className="riwayat-struk-btn"
                    onClick={() => setStrukTerpilih(pesanan)}
                  >
                    Lihat Struk
                  </IonButton>
                </div>
              ))}
            </div>
          )}
        </div>

        <div className="riwayat-footer"></div>
      </IonContent>

      {/* POP-UP STRUK */}
      <IonModal
        isOpen={!!strukTerpilih}
        onDidDismiss={() => setStrukTerpilih(null)}
        className="struk-modal"
      >
        {strukTerpilih && (
          <>
            <IonHeader>
              <IonToolbar>
                <IonTitle>Struk Pesanan</IonTitle>
                <IonButtons slot="end">
                  <IonButton onClick={() => setStrukTerpilih(null)}>
                    Tutup
                  </IonButton>
                </IonButtons>
              </IonToolbar>
            </IonHeader>

            <IonContent className="struk-content">
              <div className="struk-card">
                <div className="struk-brand">
                  <h2>KEDAI KOPI SENJA</h2>
                  <p>COFFEE & STORIES</p>
                  <span>Terima kasih telah memesan!</span>
                </div>

                <div className="struk-info">
                  <div>
                    <span>Nomor Pesanan</span>
                    <strong>#{strukTerpilih.id_pesanan}</strong>
                  </div>

                  <div>
                    <span>Tanggal</span>
                    <strong>
                      {formatTanggal(strukTerpilih.tanggal_pesanan)}
                    </strong>
                  </div>

                  {strukTerpilih.nomor_meja && (
                    <div>
                      <span>Nomor Meja</span>
                      <strong>{strukTerpilih.nomor_meja}</strong>
                    </div>
                  )}

                  {strukTerpilih.metode_pembayaran && (
                    <div>
                      <span>Pembayaran</span>
                      <strong>{strukTerpilih.metode_pembayaran}</strong>
                    </div>
                  )}
                </div>

                <div className="struk-garis"></div>

                <h3>Rincian Pesanan</h3>

                {(strukTerpilih.detail_pesanan ?? []).map((detail) => (
                  <div
                    className="struk-item"
                    key={detail.id_detail_pesanan}
                  >
                    <div className="struk-item-info">
                      <strong>
                        {detail.menu?.nama_menu ?? 'Menu'}
                      </strong>
                      <span>
                        {detail.jumlah} x {formatRupiah(detail.harga_satuan)}
                      </span>
                    </div>

                    <strong>{formatRupiah(detail.subtotal)}</strong>
                  </div>
                ))}

                <div className="struk-garis"></div>

                <div className="struk-rincian">
                  <div>
                    <span>Subtotal</span>
                    <strong>
                      {formatRupiah(strukTerpilih.subtotal)}
                    </strong>
                  </div>

                  <div>
                    <span>Biaya Layanan (5%)</span>
                    <strong>
                      {formatRupiah(strukTerpilih.biaya_layanan)}
                    </strong>
                  </div>

                  <div>
                    <span>Pajak (10%)</span>
                    <strong>
                      {formatRupiah(strukTerpilih.pajak)}
                    </strong>
                  </div>
                </div>

                <div className="struk-total">
                  <span>TOTAL</span>
                  <strong>
                    {formatRupiah(strukTerpilih.total_harga)}
                  </strong>
                </div>

                <div className="struk-penutup">
                  <p>Terima kasih sudah berkunjung</p>
                  <span>Kedai Kopi Senja</span>
                </div>
              </div>
            </IonContent>
          </>
        )}
      </IonModal>

      <BottomNav />
    </IonPage>
  );
};

export default RiwayatPesanan;
