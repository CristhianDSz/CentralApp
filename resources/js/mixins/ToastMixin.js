export const Toast = (swalInstance) => {
  return swalInstance.mixin({
      toast: true,
      position: "bottom-end",
      showConfirmButton: false,
      timer: 2500,
      timerProgressBar: false
  });
}



