FROM php:7.2.15-cli
MAINTAINER Arun Gimblett <gimblett44@gmail.com>

RUN apt-get update && apt-get -y upgrade && apt-get -y install \
    git \
    zip \
    curl
