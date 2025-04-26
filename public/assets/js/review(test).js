const allStar = document.querySelectorAll('.rating .star');
const ratingValue = document.querySelector('.rating input');

allStar.forEach((item, idx) => {
    item.addEventListener('click', function () {
        console.log('Star clicked:', idx + 1);
        ratingValue.value = idx + 1;

        allStar.forEach((i, index) => {
            if (index <= idx) {
                i.className = 'bx bxs-star star'; // filled star
                i.classList.add('active');
            } else {
                i.className = 'bx bx-star star'; // outlined star
                i.classList.remove('active');
            }
        });
    });
});

