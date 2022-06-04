const form = document.querySelector('.form');
const name = document.getElementById('name');
const number = document.getElementById('number');
const date = document.getElementById('date');
const cvv = document.getElementById('cvv');

const visa = document.querySelector('.card');

function showError(element, error) {
    if (error === true) {
        element.style.opacity = '1';
    } else {
        element.style.opacity = '0';
    }
};

name.addEventListener('input', function() {
    let alert1 = document.getElementById('alert-1');
    let error = this.value === '';
    showError(alert1, error);
    document.getElementById('card-name').textContent = this.value;
});

number.addEventListener('input', function(e) {
    this.value = numberAutoFormat();

    let error = this.value.length !== 19;
    let alert2 = document.getElementById('alert-2');
    showError(alert2, error);

    document.querySelector('.card__number').textContent = this.value;
});

function numberAutoFormat() {
    let valueNumber = number.value;
    let v = valueNumber.replace(/\s+/g, '').replace(/[^0-9]/gi, '');

    let matches = v.match(/\d{4,16}/g);
    let match = matches && matches[0] || '';
    let parts = [];

    for (i = 0; i < match.length; i += 4) {
        parts.push(match.substring(i, i + 4));
    }

    if (parts.length) {
        return parts.join(' ');
    } else {
        return valueNumber;
    }
};

date.addEventListener('input', function(e) {
    this.value = dateAutoFormat();

    let alert3 = document.getElementById('alert-3');
    showError(alert3, isNotDate(this));

    let dateNumber = date.value.match(/\d{2,4}/g);
    document.getElementById('month').textContent = dateNumber[0];
    document.getElementById('year').textContent = dateNumber[1];
});

function isNotDate(element) {
    let actualDate = new Date();
    let month = actualDate.getMonth() + 1;
    let year = Number(actualDate.getFullYear().toString().substr(-2));
    let dateNumber = element.value.match(/\d{2,4}/g);
    let monthNumber = Number(dateNumber[0]);
    let yearNumber = Number(dateNumber[1]);

    if (element.value === '' || monthNumber < 1 || monthNumber > 12 || yearNumber < year || (monthNumber <= month && yearNumber === year)) {
        return true;
    } else {
        return false;
    }
}

function dateAutoFormat() {
    let dateValue = date.value;
    let v = dateValue.replace(/\s+/g, '').replace(/[^0-9]/gi, '');

    let matches = v.match(/\d{2,4}/g);
    let match = matches && matches[0] || '';
    let parts = [];

    for (i = 0; i < match.length; i += 2) {

        parts.push(match.substring(i, i + 2));
    }

    if (parts.length) {
        return parts.join('/');
    } else {
        return dateValue;
    }
};

cvv.addEventListener('input', function(e) {
    let alert4 = document.getElementById('alert-4');
    let error = this.value.length < 3;
    showError(alert4, error)
});

function isNumeric(event) {
    if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode > 31)) {
        return false;
    }
};



form.addEventListener('submit', function(e) {
    if (name.value === '' || number.value.length !== 19 || date.value.length !== 5 || isNotDate(date) === true || cvv.value.length < 3) {
        e.preventDefault();
    };
    let input = document.querySelectorAll('input');
    for (i = 0; i < input.length; i++) {
        if (input[i].value === '') {
            input[i].nextElementSibling.style.opacity = '1';
        }
    }
});


let canvas = document.querySelector('canvas');
let cw = canvas.width = window.innerWidth;
let ch = canvas.height = window.innerHeight;

let c = canvas.getContext('2d');

// Generate random value between two values
function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Mouse object
let mouse = { x: '', y: '' };

// Assign current mouse position to the mouse object
window.addEventListener("mousemove", (e) => {
    mouse.x = e.x;
    mouse.y = e.y;
});

// On window resize, get the current screen size and initialize the globes
window.addEventListener("resize", () => {
    cw = canvas.width = window.innerWidth;
    ch = canvas.height = window.innerHeight;
    init();
});

// Globe object
function Globe(ox, oy, r, dx, dy, angle, dtheta, particlesArr) {
    this.ox = ox; // Origin x point
    this.oy = oy; // origin y point
    this.r = r; // Radius
    this.dx = dx; // Speed of the globe along the x-axis
    this.dy = dy; // Speed of the globe along the y-axis
    this.angle = angle; // Angle for the gradient shadow
    this.dtheta = dtheta; // Speed of gradient shadow roation
    this.particlesArr = particlesArr; // Particles array
    this.generate = () => {
        // Create circle
        c.beginPath();

        // Change direction of the globe movement
        if (this.ox + this.r > cw || this.ox - this.r < 0) { this.dx = -this.dx }
        if (this.oy + this.r > ch || this.oy - this.r < 0) { this.dy = -this.dy }

        c.arc(this.ox, this.oy, this.r, 0, Math.PI * 2);
        c.strokeStyle = '#a17ac2';
        c.shadowColor = '#a17ac2';
        c.shadowBlur = 8;
        c.stroke();
        c.shadowColor = 'transparent';

        // Change direction of gradient shadow rotation
        if (Math.floor(this.angle) == 120 || Math.floor(this.angle) == 60) { this.dtheta = -this.dtheta };
        this.angle += this.dtheta;

        // Get starting point and oppasite ending point for gradient shadows
        let px1 = this.ox + r * Math.cos(this.angle * Math.PI / 180);
        let py1 = this.oy + r * Math.sin(this.angle * Math.PI / 180);

        let px2 = this.ox + r * Math.cos((this.angle * Math.PI / 180) + Math.PI);
        let py2 = this.oy + r * Math.sin((this.angle * Math.PI / 180) + Math.PI);

        // Create gradient shadow
        let linGrd1 = c.createLinearGradient(px2, py2, px1, py1);
        let grdClr1 = '#7e318f';
        linGrd1.addColorStop(0.2, 'transparent');
        linGrd1.addColorStop(0.6, grdClr1 + '05');
        linGrd1.addColorStop(0.7, grdClr1 + '10');
        linGrd1.addColorStop(0.8, grdClr1 + '15');
        linGrd1.addColorStop(0.9, grdClr1 + '45');
        linGrd1.addColorStop(1, grdClr1 + '75');

        c.beginPath();
        c.arc(this.ox, this.oy, this.r, 0, Math.PI * 2);
        c.fillStyle = linGrd1;
        c.fill();

        // Create oppasite gradient shadow
        let linGrd2 = c.createLinearGradient(px1, py1, px2, py2);
        let grdClr2 = '#5a8aa6';
        linGrd2.addColorStop(0.2, 'transparent');
        linGrd2.addColorStop(0.6, grdClr2 + '05');
        linGrd2.addColorStop(0.7, grdClr2 + '10');
        linGrd2.addColorStop(0.8, grdClr2 + '15');
        linGrd2.addColorStop(0.9, grdClr2 + '45');
        linGrd2.addColorStop(1, grdClr2 + '75');

        c.beginPath();
        c.arc(this.ox, this.oy, this.r, 0, Math.PI * 2);
        c.fillStyle = linGrd2;
        c.fill();

        // Create particles
        let particleClr = ['#84dde5', '#da8fe3', '#fff', 'transparent']
        for (let i = 0; i < this.particlesArr.length; i++) {
            c.beginPath();
            c.fillStyle = particleClr[getRandomInt(0, particleClr.length - 1)];

            let particleSize = 1.5;
            (cw < 480) ? particleSize = 1: particleSize = 1.5;

            // Change particle movement direction when it reaches the globe edge (If the mouse point is not hovered on a globe and if the particle is not already released)
            if (Math.pow((this.particlesArr[i][0] - this.ox), 2) + Math.pow((this.particlesArr[i][1] - this.oy), 2) > Math.pow(this.r - particleSize, 2)) {
                if (Math.pow((mouse.x - this.ox), 2) + Math.pow((mouse.y - this.oy), 2) > Math.pow(this.r, 2) && this.particlesArr[i][5] != 'released') {
                    this.particlesArr[i][2] = -this.particlesArr[i][2];
                    this.particlesArr[i][3] = -this.particlesArr[i][3];
                } else {
                    // Mark particle as released
                    this.particlesArr[i][5] = 'released';

                    // Increase the spead of releasing particles
                    this.particlesArr[i][0] += 2 * this.particlesArr[i][2];
                    this.particlesArr[i][1] += 2 * this.particlesArr[i][3];
                }
            }

            // Increment particle position
            this.particlesArr[i][0] += this.particlesArr[i][2] + this.dx;
            this.particlesArr[i][1] += this.particlesArr[i][3] + this.dy;

            c.fillRect(this.particlesArr[i][0], this.particlesArr[i][1], particleSize, particleSize);

        }

        // Increment the globe position
        this.ox += this.dx;
        this.oy += this.dy;
    };
}

let globeArray = [];

function init() {
    globeArray = []; // Reset array

    // Set max radius of globes
    let R;
    (cw < 480) ? R = 70: R = 120;

    // Create globe array with different values
    for (let i = 0; i < 8; i++) {
        let r = getRandomInt(R - 40, R); // Radius of globes

        // Define globe origin points
        let ox = getRandomInt(0 + R, cw - R);
        let oy = getRandomInt(0 + R, ch - R);

        // Get random velocity for the globe
        let dx = (Math.random() - 0.5) * 2;
        let dy = (Math.random() - 0.5) * 2;

        // Get random angle to get random starting point and oppasite ending point for gradient shadows
        let angle = getRandomInt(60, 120);

        let dtheta = 0.1; // Speed of gradient shadow rotation

        // Particles with random positions
        let particlesArr = [];
        for (let i = 0; i < 5 * r; i++) {
            let rx = getRandomInt(ox - r, ox + r);
            let ry = getRandomInt(oy - r, oy + r);

            let dx = Math.random() - 0.5;
            let dy = Math.random() - 0.5;
            particlesArr.push([rx, ry, dx, dy, '']);

            // Remove particles outside the globe
            if (Math.pow((rx - ox), 2) + Math.pow((ry - oy), 2) >= Math.pow(r, 2)) {
                particlesArr.pop();
            }
        }

        globeArray.push(new Globe(ox, oy, r, dx, dy, angle, dtheta, particlesArr));
    }
}
init();

function animate() {
    requestAnimationFrame(animate);
    c.clearRect(0, 0, cw, ch);

    for (let i = 0; i < globeArray.length; i++) {
        globeArray[i].generate(i);
    }

}
animate();