FROM node:18.18.2-slim

LABEL maintainers="mountain-routes-crew"

RUN mkdir mountain-routes

WORKDIR /mountain-routes

RUN npm install -g @angular/cli

COPY package*.json .

RUN npm install

COPY . .

RUN npm run build

EXPOSE 4200

CMD ["npm", "start"]