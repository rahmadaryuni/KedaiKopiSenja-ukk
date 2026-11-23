
import { IonIcon } from '@ionic/react';
import {
  cafeOutline,
  receiptOutline,
  personOutline,
} from 'ionicons/icons';
import { useLocation, useNavigate } from 'react-router-dom';
import './BottomNav.css';

const BottomNav: React.FC = () => {
  const navigate = useNavigate();
  const location = useLocation();

  const menuNavigasi = [
    {
      label: 'Menu',
      path: '/menu',
      icon: cafeOutline,
    },
    {
      label: 'Pesanan',
      path: '/riwayat-pesanan',
      icon: receiptOutline,
    },
    {
      label: 'Akun',
      path: '/akun',
      icon: personOutline,
    },
  ];

  return (
    <div className="bottom-nav">
      {menuNavigasi.map((item) => (
        <button
          key={item.path}
          className={`bottom-nav-item ${
            location.pathname === item.path ? 'active' : ''
          }`}
          onClick={() => navigate(item.path)}
        >
          <IonIcon icon={item.icon} />
          <span>{item.label}</span>
        </button>
      ))}
    </div>
  );
};

export default BottomNav;
