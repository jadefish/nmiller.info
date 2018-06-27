FROM nginx:stable-alpine
WORKDIR "/etc/nginx"

ADD ./default.conf /etc/nginx/conf.d/default.conf

CMD ["nginx", "-g", "daemon off;"]
