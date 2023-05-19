FROM nginx:alpine

RUN adduser -u 82 -D -S -G www-data www-data

#install package
#The image is Alpine based, so you can't use apt-get because it's Ubuntu's package manager.
RUN apk update
RUN apk add vim zip unzip git curl sudo procps make autoconf
RUN apk add nodejs npm

#copy nginx config to container
COPY nginx/include /etc/nginx/include
COPY nginx/nginx.conf /etc/nginx/
COPY nginx/fastcgi_params /etc/nginx/
COPY nginx/conf.d/ /etc/nginx/conf.d/

