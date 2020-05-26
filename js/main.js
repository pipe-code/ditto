import '../sass/main.scss'
import $ from 'jquery';

window.ditto = {
    menu: (el) => {
        $(el).toggleClass('open');
    }
}