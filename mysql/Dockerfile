FROM mysql:5.7.32

RUN echo "USE mysql;" > /docker-entrypoint-initdb.d/timezones.sql &&  mysql_tzinfo_to_sql /usr/share/zoneinfo >> /docker-entrypoint-initdb.d/timezones.sql
ENV mysql_data=/var/lib/mysql

# initdb -> jobar.sql
COPY --chown=mysql:mysql ../mysql/init/jobar.sql /docker-entrypoint-initdb.d/jobar.sql


# 把容器裡面的資料 export 至本機上面, 如果compose.volumn有定義./MySQL_DATA 則會自動建立資料夾
RUN export mysql_data=/var/lib/mysql