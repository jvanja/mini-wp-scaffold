import '../scss/style.scss';

console.log('Hello from main.js');

document.addEventListener('DOMContentLoaded', () => {
    const h1 = document.createElement('h1');
    h1.textContent = 'Hello, HMR is working!';
    document.body.appendChild(h1);

    if (import.meta.hot) {
        import.meta.hot.accept(() => {
            console.log('HMR accepted!');
            h1.textContent = 'HMR updated the content!';
        });
    }
});
