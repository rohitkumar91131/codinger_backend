# आधिकारिक PHP इमेज का उपयोग Apache के साथ करें
FROM php:8.1-apache

# Apache के लिए `mod_rewrite` को इनेबल करें, जो CodeIgniter के लिए ज़रूरी है
RUN a2enmod rewrite

# अपनी प्रोजेक्ट फ़ाइलों को Apache के डिफ़ॉल्ट वेब रूट में कॉपी करें
COPY . /var/www/html/

# `writable` डायरेक्टरी के लिए सही अनुमतियाँ (permissions) सेट करें
RUN chown -R www-data:www-data /var/www/html/writable
RUN chmod -R 755 /var/www/html/writable

# Apache के लिए पोर्ट 80 को एक्सपोज़ करें
EXPOSE 80

