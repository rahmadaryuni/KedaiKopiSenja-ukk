
import { IonContent, IonPage, IonInput, IonButton } from '@ionic/react';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { apiRequest } from '../services/api';
import './Login.css';

const Login: React.FC = () => {
  const navigate = useNavigate();

  const [noHp, setNoHp] = useState('');
  const [password, setPassword] = useState('');
  const [loading, setLoading] = useState(false);

  const handleLogin = async () => {
    if (!noHp || !password) {
      alert('Nomor HP dan password wajib diisi.');
      return;
    }

    try {
      setLoading(true);

      const hasil = await apiRequest('/pelanggan/login', 'POST', {
        no_hp: noHp,
        password,
      });

      if (!hasil.token) {
        throw new Error('Token login tidak ditemukan dari server.');
      }

      localStorage.setItem('pelanggan_token', hasil.token);

      const wajibGantiPassword =
      hasil.pelanggan?.wajib_ganti_password === true ||
      hasil.pelanggan?.wajib_ganti_password === 1 ||
      hasil.pelanggan?.wajib_ganti_password === '1';

      localStorage.setItem(
        'pelanggan_wajib_ganti_password',
        wajibGantiPassword ? '1' : '0'
      );
      if (wajibGantiPassword) {
        alert('Password kamu merupakan password sementara. Silakan ganti password terlebih dahulu.');
        navigate('/akun', { replace: true });
        return;
      }

      alert('Login berhasil! Selamat datang di Kedai Kopi Senja.');
      navigate('/menu', { replace: true });

    } catch (error) {
      alert(error instanceof Error ? error.message : 'Login gagal.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <IonPage>
      <IonContent fullscreen className="login-content">
        <div className="login-header">
          <div className="login-logo"></div>
          <h1>Selamat datang</h1>
          <p>Pesan kopi favoritmu dari meja</p>
        </div>

        <div className="login-card">
          <div className="login-field">
            <label>Nomor HP</label>
            <IonInput
              type="tel"
              value={noHp}
              onIonInput={(e) => setNoHp(e.detail.value ?? '')}
              placeholder="081234567890"
              fill="outline"
            />
          </div>

          <div className="login-field">
            <label>Password</label>
            <IonInput
              type="password"
              value={password}
              onIonInput={(e) => setPassword(e.detail.value ?? '')}
              placeholder="••••••••"
              fill="outline"
            />
          </div>

          <IonButton
            expand="block"
            className="login-button"
            onClick={handleLogin}
            disabled={loading}
          >
            {loading ? 'Memproses...' : 'Masuk'}
          </IonButton>
        </div>

        <div className="login-footer">
          <p>Belum punya akun? <a href="/register">Daftar</a></p>
          <p>Lupa password? Minta Kasir mereset.</p>
        </div>
      </IonContent>
    </IonPage>
  );
};

export default Login;
