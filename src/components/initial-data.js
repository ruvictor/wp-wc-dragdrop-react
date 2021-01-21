import menu1 from '../assets/1.jpg';
import menu2 from '../assets/2.jpg';
import menu3 from '../assets/3.jpg';

const initialData = {
    consumer_key: 'ck_d8d533b58c08de9ad21cc73ea9cca871ef8857a7',
    consumer_secret: 'cs_6a0bff1dbf6841f218651d8a3c9faa73a2f831ea',
    isLoaded: false,
    products: {
        '17': {id: '17', content: menu1, price: '50'},
        '15': {id: '15', content: menu2, price: '10'},
        '24': {id: '24', content: menu3, price: '6'},
        '25': {id: '25', content: menu1, price: '18'},
        '26': {id: '26', content: menu2, price: '11'},
        '27': {id: '27', content: menu1, price: '2'},
        '28': {id: '28', content: menu3, price: '3'}
    },
    totalPrice: 0,
    productsColumn: {
        products:{
            id: 'products',
            title: 'Products',
            productIds: []
            // productIds: ['17', '15', '24', '25', '26', '27', '28']
            // productIds: ['product-1', 'product-2', 'product-3', 'product-4', 'product-5', 'product-6', 'product-7']
        }
    },
    days: {
        'monday': {
            id: 'monday',
            title: 'Monday',
            productIds: [],
        },
        'tuesday': {
            id: 'tuesday',
            title: 'Tuesday',
            productIds: [],
        },
        'wednesday': {
            id: 'wednesday',
            title: 'Wednesday',
            productIds: [],
        },
        'thursday': {
            id: 'thursday',
            title: 'Thursday',
            productIds: [],
        },
        'friday': {
            id: 'friday',
            title: 'Friday',
            productIds: [],
        },
        'saturday': {
            id: 'saturday',
            title: 'Saturday',
            productIds: [],
        },
        'sunday': {
            id: 'sunday',
            title: 'Sunday',
            productIds: [],
        },
    },
    daysOrder: ['monday','tuesday','wednesday','thursday','friday','saturday','sunday']
}

export default initialData;