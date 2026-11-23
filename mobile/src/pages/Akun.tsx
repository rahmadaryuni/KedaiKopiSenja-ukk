
import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  IonContent,
  IonPage,
  IonSpinner,
  IonButton,
} from '@ionic/react';
import { apiRequest } from '../services/api';
import BottomNav from '../components/BottomNav';
import './Akun.css';

interface DataPelanggan {
  id_pelanggan: number;
  nama: string;
  no_hp: string;
  wajib_ganti_password: boolean | number | string;
}

const Akun: React.FC = () => {
  const [pelanggan, setPelanggan] = useState<DataPelanggan | null>(null);
  const [loading, setLoading] = useState(true);
  const [loadingPassword, setLoadingPassword] = useState(false);
  const [loadingLogout, setLoadingLogout] = useState(false);

  const [passwordLama, setPasswordLama] = useState('');
  const [passwordBaru, setPasswordBaru] = useState('');
  const [konfirmasiPassword, setKonfirmasiPassword] = useState('');

  const [pesan, setPesan] = useState('');
  const [error, setError] = useState('');

  const navigate = useNavigate();

  const wajibGantiPassword =
    pelanggan?.wajib_ganti_password === true ||
    pelanggan?.wajib_ganti_password === 1 ||
    pelanggan?.wajib_ganti_password === '1';

  useEffect(() => {
    const ambilProfil = async () => {
      const token = localStorage.getItem('pelanggan_token');

      if (!token) {
        navigate('/login', { replace: true });
        return;
      }

      try {
        const hasil = await apiRequest(
          '/pelanggan/profil',
          'GET',
          undefined,
          token
        );

        const dataPelanggan = hasil.pelanggan;

        setPelanggan(dataPelanggan);

        const wajibGanti =
          dataPelanggan?.wajib_ganti_password === true ||
          dataPelanggan?.wajib_ganti_password === 1 ||
          dataPelanggan?.wajib_ganti_password === '1';

        localStorage.setItem(
          'pelanggan_wajib_ganti_password',
          wajibGanti ? '1' : '0'
        );
      } catch (err) {
        setError(
          err instanceof Error ? err.message : 'Gagal mengambil profil.'
        );
      } finally {
        setLoading(false);
      }
    };

    ambilProfil();
  }, [navigate]);

  const ubahPassword = async () => {
    setPesan('');
    setError('');

    if (!passwordLama || !passwordBaru || !konfirmasiPassword) {
      setError('Semua kolom password wajib diisi.');
      return;
    }

    if (passwordBaru.length < 8) {
      setError('Password baru minimal 8 karakter.');
      return;
    }

    if (passwordBaru !== konfirmasiPassword) {
      setError('Konfirmasi password baru tidak sama.');
      return;
    }

    const token = localStorage.getItem('pelanggan_token');

    if (!token) {
      navigate('/login', { replace: true });
      return;
    }

    setLoadingPassword(true);

    try {
      const hasil = await apiRequest(
        '/pelanggan/ubah-password',
        'PUT',
        {
          password_lama: passwordLama,
          password_baru: passwordBaru,
          password_baru_confirmation: konfirmasiPassword,
        },
        token
      );

      setPesan(hasil.message || 'Password berhasil diperbarui.');

      setPasswordLama('');
      setPasswordBaru('');
      setKonfirmasiPassword('');

      // Perbarui status password sementara
      localStorage.setItem('pelanggan_wajib_ganti_password', '0');

      setPelanggan(prev =>
        prev ? { ...prev, wajib_ganti_password: false } : prev
      );

      if (wajibGantiPassword) {
        setPesan(
          'Password sementara berhasil diganti! Sekarang kamu bisa menggunakan aplikasi.'
        );
      }
    } catch (err) {
      setError(
        err instanceof Error ? err.message : 'Gagal mengubah password.'
      );
    } finally {
      setLoadingPassword(false);
    }
  };

  const logout = async () => {
    const token = localStorage.getItem('pelanggan_token');

    setLoadingLogout(true);

    try {
      if (token) {
        await apiRequest(
          '/pelanggan/logout',
          'POST',
          undefined,
          token
        );
      }
    } catch (err) {
      console.error('Gagal menghubungi API logout:', err);
    } finally {
      localStorage.removeItem('pelanggan_token');
      localStorage.removeItem('pelanggan_wajib_ganti_password');
      localStorage.removeItem('keranjang_senja');

      navigate('/login', { replace: true });
    }
  };

  return (
    <IonPage>
      <IonContent fullscreen className="akun-content">
        <div className="akun-header">
          <p>KEDAI KOPI SENJA</p>
          <h1>Akun Saya</h1>
          <span>Kelola informasi akunmu</span>
        </div>

        <div className="akun-container">
          {loading ? (
            <div className="akun-loading">
              <IonSpinner />
              <p>Memuat profil...</p>
            </div>
          ) : (
            <>
              <div className="profil-card">
                <div className="profil-avatar">
                  {pelanggan?.nama?.charAt(0).toUpperCase() || 'P'}
                </div>

                <div className="profil-info">
                  <span>Profil Pelanggan</span>
                  <h2>{pelanggan?.nama || '-'}</h2>
                  <p>{pelanggan?.no_hp || '-'}</p>
                </div>
              </div>

              {wajibGantiPassword && (
                <div className="akun-error">
                  Password kamu telah direset oleh kasir.
                  Silakan ganti password sementara sebelum menggunakan fitur aplikasi lainnya.
                </div>
              )}

              <div className="akun-section">
                <h2>Informasi Akun</h2>

                <div className="akun-field">
                  <label>Nama Lengkap</label>
                  <div className="akun-value">
                    {pelanggan?.nama || '-'}
                  </div>
                </div>

                <div className="akun-field">
                  <label>Nomor Handphone</label>
                  <div className="akun-value">
                    {pelanggan?.no_hp || '-'}
                  </div>
                </div>
              </div>

              <div className="akun-section password-section">
                <h2>Ubah Password</h2>

                <p className="akun-description">
                  {wajibGantiPassword
                    ? 'Buat password baru untuk mengaktifkan kembali akunmu.'
                    : 'Gunakan password minimal 8 karakter.'}
                </p>

                <div className="akun-field">
                  <label>Password Lama</label>
                  <input
                    type="password"
                    value={passwordLama}
                    onChange={(e) => setPasswordLama(e.target.value)}
                    placeholder="Masukkan password lama"
                  />
                </div>

                <div className="akun-field">
                  <label>Password Baru</label>
                  <input
                    type="password"
                    value={passwordBaru}
                    onChange={(e) => setPasswordBaru(e.target.value)}
                    placeholder="Masukkan password baru"
                  />
                </div>

                <div className="akun-field">
                  <label>Konfirmasi Password Baru</label>
                  <input
                    type="password"
                    value={konfirmasiPassword}
                    onChange={(e) => setKonfirmasiPassword(e.target.value)}
                    placeholder="Ulangi password baru"
                  />
                </div>

                {pesan && <p className="akun-success">{pesan}</p>}
                {error && <p className="akun-error">{error}</p>}

                <IonButton
                  expand="block"
                  className="password-button"
                  onClick={ubahPassword}
                  disabled={loadingPassword}
                >
                  {loadingPassword
                    ? 'Menyimpan...'
                    : wajibGantiPassword
                      ? 'Ganti Password Sekarang'
                      : 'Simpan Password'}
                </IonButton>
              </div>

              <div className="akun-logout">
                <IonButton
                  expand="block"
                  className="logout-button"
                  onClick={logout}
                  disabled={loadingLogout}
                >
                  {loadingLogout ? 'Keluar...' : 'Logout'}
                </IonButton>
              </div>
            </>
          )}
        </div>
      </IonContent>

      {!wajibGantiPassword && <BottomNav />}
    </IonPage>
  );
};

export default Akun;
