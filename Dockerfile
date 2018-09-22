FROM nginx:alpine

COPY /dist /usr/share/nginx/html/
#COPY /glammy_full_noimage /usr/share/nginx/html/
#docker run -d --rm --name nginx -p 80:80 -v c:/sources/greensize/AdminLTE-2.4.5:/usr/share/nginx/html nginx:alpine

EXPOSE 80
