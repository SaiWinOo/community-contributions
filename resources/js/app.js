import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const userTheme = localStorage.getItem('theme');
const systemTheme = window.matchMedia("(prefers-color-scheme)").matches;

const  themeCheck = () =>{
    if(userTheme === 'dark' || (!userTheme && systemTheme)){
        document.documentElement.classList.add('dark');
        return;
    }
}

const themeSwitch =()=>{
    if(document.documentElement.classList.contains('dark')){
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        return;
    }
    document.documentElement.classList.add('dark');
    localStorage.setItem('theme', 'dark');
}

themeCheck();

const dark = document.getElementById('darkMode');
dark.addEventListener('click', themeSwitch)

