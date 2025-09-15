import $ from 'jquery';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
  const pictureElements = document.querySelectorAll('.text-with-image__picture');
  pictureElements.forEach((pictureElement) => {
    const beforeElement = pictureElement.querySelector('.before');
    const afterElement = pictureElement.querySelector('.after');

    if (beforeElement) {
      gsap.fromTo(
        beforeElement,
        { scale: 0.75, opacity: 0, x: -40, y: 80, rotate: -10 },
        {
          scale: 1.05,
          opacity: 0.12,
          x: 0,
          y: 0,
          rotate: 0,
          duration: 1.2,
          ease: 'power3.out',
          scrollTrigger: { trigger: pictureElement, start: 'top 80%', toggleActions: 'play none none none' },
        },
      );
      gsap.to(beforeElement, {
        x: 32,
        y: -28,
        rotate: 6,
        duration: 5.2,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: 0.2,
      });
      gsap.to(beforeElement, { scale: 1.08, duration: 4.4, repeat: -1, yoyo: true, ease: 'sine.inOut', delay: 0.6 });
      gsap.to(beforeElement, {
        y: '+=80',
        ease: 'none',
        scrollTrigger: { trigger: pictureElement, start: 'top bottom', end: 'bottom top', scrub: true },
      });
    }

    if (afterElement) {
      gsap.fromTo(
        afterElement,
        { scale: 1.25, opacity: 0, x: 50, y: -90, rotate: 12 },
        {
          scale: 1,
          opacity: 0.12,
          x: 0,
          y: 0,
          rotate: 0,
          duration: 1.3,
          ease: 'power3.out',
          scrollTrigger: { trigger: pictureElement, start: 'top 80%', toggleActions: 'play none none none' },
        },
      );
      gsap.to(afterElement, {
        x: -36,
        y: 30,
        rotate: -7,
        duration: 6.1,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: 0.1,
      });
      gsap.to(afterElement, { scale: 0.94, duration: 4.8, repeat: -1, yoyo: true, ease: 'sine.inOut', delay: 0.7 });
      gsap.to(afterElement, {
        y: '-=80',
        ease: 'none',
        scrollTrigger: { trigger: pictureElement, start: 'top bottom', end: 'bottom top', scrub: true },
      });
    }
  });
});
