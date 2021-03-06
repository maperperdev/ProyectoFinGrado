import Home from './components/Home';
import BuyAsset from './components/BuyAsset';
import SellAsset from './components/SellAsset';
import PortfolioValue from './components/PortfolioValue';
import Graphics from './components/Graphics';
import DeleteAccount from './components/DeleteAccount';

export default {
    mode: 'history',
    routes: [
        {
            path: '/home',
            component: Home,
        },
        {
            path: '/home/buy-assets',
            component: BuyAsset,
        },
        {
            path: '/home/sell-assets',
            component: SellAsset,
        },
        {
            path: '/home/graphics',
            component: Graphics,
        },
        {
            path: '/home/porfolio-value',
            component: PortfolioValue,
        },
        {
            path: '/home/delete-account',
            component: DeleteAccount,
        },
    ]
};