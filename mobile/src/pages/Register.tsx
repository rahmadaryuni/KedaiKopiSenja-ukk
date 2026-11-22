
import { IonContent, IonPage, IonInput, IonButton } from '@ionic/react';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { apiRequest } from '../services/api';
import './Register.css';

const Register: React.FC = () => {
  const navigate = useNavigate();

  const [nama, setNama] = useState('');
  const [noHp, setNoHp] = useState('');
  const [password, setPassword] = useState('');
  const [konfirmasi, setKonfirmasi] = useState('');
  const [loading, setLoading] = useState(false);

  const handleRegister = async () => {
    if (!nama || !noHp || !password || !konfirmasi) {
      alert('Semua kolom wajib diisi.');
      return;
    }

    if (password.length < 8) {
      alert('Password minimal 8 karakter.');
      return;
    }

    if (password !== konfirmasi) {
      alert('Konfirmasi password tidak sama.');
      return;
    }

    try {
      setLoading(true);

      const hasil = await apiRequest('/pelanggan/register', 'POST', {
        nama,
        no_hp: noHp,
        password,
        password_confirmation: konfirmasi,
      });

      alert(hasil.message || 'Pendaftaran berhasil!');
      navigate('/login',{replace:true});
    } catch (error) {
      alert(error instanceof Error ? error.message : 'Pendaftaran gagal.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <IonPage>
      <IonContent fullscreen className="register-content">
        <div className="register-header">
          <div className="register-logo"></div>
          <h1>Buat Akun</h1>
          <p>Bergabung dan nikmati kopi favoritmu</p>
        </div>

        <div className="register-card">
          <div className="register-field">
            <label>Nama Lengkap</label>
            <IonInput value={nama} onIonInput={(e) => setNama(e.detail.value ?? '')} placeholder="Masukkan nama lengkap" fill="outline" />
          </div>

          <div className="register-field">
            <label>Nomor HP</label>
            <IonInput type="tel" value={noHp} onIonInput={(e) => setNoHp(e.detail.value ?? '')} placeholder="Masukkan nomor HP" fill="outline" />
          </div>

          <div className="register-field">
            <label>Password</label>
            <IonInput type="password" value={password} onIonInput={(e) => setPassword(e.detail.value ?? '')} placeholder="Minimal 8 karakter" fill="outline" />
          </div>

          <div className="register-field">
            <label>Konfirmasi Password</label>
            <IonInput type="password" value={konfirmasi} onIonInput={(e) => setKonfirmasi(e.detail.value ?? '')} placeholder="Ulangi password" fill="outline" />
          </div>

          <IonButton expand="block" className="register-button" onClick={handleRegister} disabled={loading}>
            {loading ? 'Memproses...' : 'Daftar Sekarang'}
          </IonButton>
        </div>

        <div className="register-footer">
          <p>Sudah punya akun? <a href="/login">Masuk</a></p>
        </div>
      </IonContent>
    </IonPage>
  );
};

export default Register;
