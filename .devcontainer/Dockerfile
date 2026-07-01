FROM wordpress:7

ARG UID=1000
ARG GID=1000

RUN groupadd --gid ${GID} wordpress && \
    useradd --uid ${UID} --gid ${GID} --create-home --shell /bin/bash wordpress
