require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import HeaderLandingPage from './components/HeaderLandingPage';
import Footer from './components/Footer';
import ListOfAssets from './components/ListOfAssets';
import Home from './components/Home';
import BuyAsset from './components/BuyAsset';
import SellAsset from './components/SellAsset';
import PortfolioValue from './components/PortfolioValue';
import Graphics from './components/Graphics';
import Account from './components/Account';
import DeleteAccount from './components/DeleteAccount';
import DeleteAccountModal from './components/DeleteAccountModal';
import Modal from "@burhanahmeed/vue-modal-2";


Vue.use(VueRouter);
Vue.use(Modal);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    components: {
        'header-landing-page': HeaderLandingPage,
        'my-footer': Footer,
        'list-of-assets': ListOfAssets,
        'home': Home,
        'buy-asset': BuyAsset,
        'sell-asset': SellAsset,
        'porfolio-value': PortfolioValue,
        'graphics': Graphics,
        'account': Account,
        'delete-account': DeleteAccount,
        'delete-account-modal': DeleteAccountModal,
    }
});