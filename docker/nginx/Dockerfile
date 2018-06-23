FROM nginx:stable-alpine
WORKDIR "/etc/nginx"

ADD ./default.conf /etc/nginx/conf.d

CMD ["nginx", "-g", "daemon off;"]
