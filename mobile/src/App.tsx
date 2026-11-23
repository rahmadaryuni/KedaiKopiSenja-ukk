
import { IonApp, IonRouterOutlet, setupIonicReact } from '@ionic/react';
import { IonReactRouter } from '@ionic/react-router';
import { Navigate, Route } from 'react-router-dom';
import { type ReactNode } from 'react';

import Register from './pages/Register';
import Login from './pages/Login';
import Menu from './pages/Menu';
import Keranjang from './pages/Keranjang';
import Akun from './pages/Akun';
import RiwayatPesanan from './pages/RiwayatPesanan';

/* Core CSS */
import '@ionic/react/css/core.css';
import '@ionic/react/css/normalize.css';
import '@ionic/react/css/structure.css';
import '@ionic/react/css/typography.css';

/* Ionic CSS utilities */
import '@ionic/react/css/padding.css';
import '@ionic/react/css/float-elements.css';
import '@ionic/react/css/text-alignment.css';
import '@ionic/react/css/text-transformation.css';
import '@ionic/react/css/flex-utils.css';
import '@ionic/react/css/display.css';

/* Theme */
import './theme/variables.css';

setupIonicReact();

const PelangganRoute = ({
  children,
  bolehSaatWajibGanti = false,
}: {
  children: ReactNode;
  bolehSaatWajibGanti?: boolean;
}) => {
  const token = localStorage.getItem('pelanggan_token');
  const wajibGantiPassword =
    localStorage.getItem('pelanggan_wajib_ganti_password') === '1';

  if (!token) {
    return <Navigate to="/login" replace />;
  }

  if (wajibGantiPassword && !bolehSaatWajibGanti) {
    return <Navigate to="/akun" replace />;
  }

  return <>{children}</>;
};

const App: React.FC = () => (
  <IonApp>
    <IonReactRouter>
      <IonRouterOutlet>
        {/* Halaman publik */}
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />

        {/* Halaman pelanggan */}
        <Route
          path="/menu"
          element={
            <PelangganRoute>
              <Menu />
            </PelangganRoute>
          }
        />

        <Route
          path="/keranjang"
          element={
            <PelangganRoute>
              <Keranjang />
            </PelangganRoute>
          }
        />

        <Route
          path="/riwayat-pesanan"
          element={
            <PelangganRoute>
              <RiwayatPesanan />
            </PelangganRoute>
          }
        />

        <Route
          path="/akun"
          element={
            <PelangganRoute bolehSaatWajibGanti>
              <Akun />
            </PelangganRoute>
          }
        />

        {/* Halaman awal */}
        <Route path="/" element={<Navigate to="/login" replace />} />
      </IonRouterOutlet>
    </IonReactRouter>
  </IonApp>
);

export default App;
