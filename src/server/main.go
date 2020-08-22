package main

import (
	"path/filepath"
	"fmt"
	"log"
	"net/http"
	"os"
	"strconv"
	"time"
)

type errEnvVarNotFound struct {
	key string
}

func (e errEnvVarNotFound) Error() string {
	return fmt.Sprintf("env var %s not found", e.key)
}

func main() {
	root, err := getEnvVar("CONTENT_ROOT")
	exitIf(err)

	addr, err := getEnvVar("ADDRESS")
	exitIf(err)

	timeout, err := getEnvVar("READ_TIMEOUT")
	exitIf(err)
	timeoutInt, err := strconv.Atoi(timeout)
	exitIf(err)

	fs := extensionFS{
		dir: http.Dir(root),
		ext: ".html",
	}
	server := &http.Server{
		Addr: addr,
		Handler: http.FileServer(fs),
		ReadTimeout: time.Duration(timeoutInt) * time.Second,
		MaxHeaderBytes: 1 << 12,
	}

	log.Fatal(server.ListenAndServe())
}

func getEnvVar(key string) (string, error) {
	if v, ok := os.LookupEnv(key); ok {
		return v, nil
	}

	return "", errEnvVarNotFound{key}
}

func exitIf(err error) {
	if err != nil {
		log.Fatalln(err)
	}
}

type extensionFS struct {
	dir http.Dir
	ext string
}

func (fs extensionFS) Open(name string) (http.File, error) {
	if name != "/" && filepath.Ext(name) == "" {
		// append the default extension if none is provided:
		name = name + fs.ext
	}

	log.Printf("fs: open %s\n", name)

	return fs.dir.Open(name)
}
