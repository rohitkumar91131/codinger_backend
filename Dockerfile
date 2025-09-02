# आधिकारिक PHP इमेज का उपयोग Apache के साथ करें
FROM php:8.1-apache

# Apache के लिए `mod_rewrite` को इनेबल करें
RUN a2enmod rewrite

# कॉन्फ़िगरेशन फ़ाइल को `sites-available` में कॉपी करें
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# डिफ़ॉल्ट कॉन्फ़िगरेशन को डिसेबल करें और नया कॉन्फ़िगरेशन इनेबल करें
RUN a2dissite 000-default.conf
RUN a2ensite 000-default.conf

# फ़ाइलें कॉपी करने से पहले एक खाली वेब रूट बनाएँ
RUN mkdir -p /var/www/html/public

# अपनी प्रोजेक्ट फ़ाइलों को कंटेनर में कॉपी करें
COPY . /var/www/html/

# `writable` डायरेक्टरी के लिए अनुमतियाँ सेट करें
RUN chown -R www-data:www-data /var/www/html/writable
RUN chmod -R 755 /var/www/html/writable

# Apache के लिए पोर्ट 80 को एक्सपोज़ करें
EXPOSE 80

